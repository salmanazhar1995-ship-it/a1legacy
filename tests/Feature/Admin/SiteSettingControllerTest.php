<?php

namespace Tests\Feature\Admin;

use App\Models\SiteSetting;
use App\Models\User;
use App\Support\MediaStorage;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class SiteSettingControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_update_known_site_settings_and_unknown_keys_are_ignored(): void
    {
        $admin = User::factory()->admin()->create();
        $setting = SiteSetting::factory()->create(['key' => 'site_name', 'value' => 'Old name']);

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'settings' => ['site_name' => 'New name', 'is_admin' => '1'],
        ]);

        $response->assertRedirect()->assertSessionHas('success');
        $this->assertSame('New name', $setting->refresh()->value);
        $this->assertDatabaseMissing('site_settings', ['key' => 'is_admin']);
    }

    public function test_admin_can_manage_retell_voice_widget_credentials(): void
    {
        $admin = User::factory()->admin()->create();

        $settingsPage = $this->actingAs($admin)->get(route('admin.settings.index'));

        $settingsPage
            ->assertSee('name="settings[retell_voice_public_key]"', false)
            ->assertSee('name="settings[retell_voice_agent_id]"', false);

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'settings' => [
                'retell_voice_public_key' => 'public_key_from_admin',
                'retell_voice_agent_id' => 'agent_id_from_admin',
            ],
        ]);

        $response->assertRedirect()->assertSessionHas('success');
        $this->assertDatabaseHas('site_settings', [
            'key' => 'retell_voice_public_key',
            'value' => 'public_key_from_admin',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'retell_voice_agent_id',
            'value' => 'agent_id_from_admin',
        ]);
    }

    public function test_smtp_settings_are_rendered_without_exposing_the_saved_password(): void
    {
        $admin = User::factory()->admin()->create();
        SiteSetting::query()->where('key', 'smtp_password')->update([
            'value' => Crypt::encryptString('saved-smtp-secret'),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.settings.index'));

        $response
            ->assertOk()
            ->assertSee('id="smtp-settings"', false)
            ->assertSee('name="settings[smtp_host]"', false)
            ->assertSee('name="settings[smtp_port]"', false)
            ->assertSee('name="settings[smtp_encryption]"', false)
            ->assertSee('name="settings[smtp_username]"', false)
            ->assertSee('name="settings[smtp_password]"', false)
            ->assertSee('name="settings[smtp_from_address]"', false)
            ->assertSee('name="settings[smtp_from_name]"', false)
            ->assertSee('A password is saved securely.')
            ->assertDontSee('saved-smtp-secret');
    }

    public function test_admin_can_update_smtp_settings_and_runtime_mail_configuration(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'settings' => [
                'smtp_enabled' => '1',
                'smtp_host' => 'smtp.example.com',
                'smtp_port' => '465',
                'smtp_encryption' => 'ssl',
                'smtp_username' => 'mailer@example.com',
                'smtp_password' => 'smtp-secret',
                'smtp_from_address' => 'hello@example.com',
                'smtp_from_name' => 'A1 Legacy',
            ],
        ]);

        $response->assertRedirect()->assertSessionHas('success');
        $encryptedPassword = SiteSetting::query()->where('key', 'smtp_password')->value('value');
        $this->assertNotSame('smtp-secret', $encryptedPassword);
        $this->assertSame('smtp-secret', Crypt::decryptString($encryptedPassword));
        $this->assertSame('smtp', config('mail.default'));
        $this->assertSame('smtps', config('mail.mailers.smtp.scheme'));
        $this->assertSame('smtp.example.com', config('mail.mailers.smtp.host'));
        $this->assertSame(465, config('mail.mailers.smtp.port'));
        $this->assertSame('mailer@example.com', config('mail.mailers.smtp.username'));
        $this->assertSame('smtp-secret', config('mail.mailers.smtp.password'));
        $this->assertSame('hello@example.com', config('mail.from.address'));
        $this->assertSame('A1 Legacy', config('mail.from.name'));
    }

    public function test_blank_smtp_password_keeps_the_saved_secret(): void
    {
        $admin = User::factory()->admin()->create();
        $encryptedPassword = Crypt::encryptString('saved-smtp-secret');
        SiteSetting::query()->where('key', 'smtp_password')->update(['value' => $encryptedPassword]);

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'settings' => [
                'smtp_enabled' => '0',
                'smtp_password' => '',
            ],
        ]);

        $response->assertRedirect()->assertSessionHas('success');
        $this->assertDatabaseHas('site_settings', [
            'key' => 'smtp_password',
            'value' => $encryptedPassword,
        ]);
        $this->assertSame('array', config('mail.default'));
    }

    public function test_enabled_smtp_requires_valid_connection_and_sender_settings(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->from(route('admin.settings.index'))->put(route('admin.settings.update'), [
            'settings' => [
                'smtp_enabled' => '1',
                'smtp_host' => '',
                'smtp_port' => '70000',
                'smtp_encryption' => 'invalid',
                'smtp_password' => 'must-not-be-flashed',
                'smtp_from_address' => 'not-an-email',
                'smtp_from_name' => '',
            ],
        ]);

        $response
            ->assertRedirect(route('admin.settings.index'))
            ->assertSessionHasErrors([
                'settings.smtp_host',
                'settings.smtp_port',
                'settings.smtp_encryption',
                'settings.smtp_from_address',
                'settings.smtp_from_name',
            ])
            ->assertSessionMissingInput('settings.smtp_password');
    }

    public function test_admin_can_upload_a_branding_image(): void
    {
        $admin = User::factory()->admin()->create();
        $setting = SiteSetting::factory()->create([
            'key' => 'header_logo',
            'group' => 'branding',
            'type' => 'image',
            'value' => null,
        ]);
        $image = UploadedFile::fake()->createWithContent(
            'header-logo.png',
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M/wHwAF/gL+XrC4WQAAAABJRU5ErkJggg=='),
        );

        $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
            'setting_media_types' => ['header_logo' => 'image'],
            'setting_image_alts' => ['header_logo' => 'A1 Legacy Labs header logo'],
            'setting_files' => ['header_logo' => $image],
        ]);

        $response->assertRedirect()->assertSessionHas('success');
        $setting->refresh();
        $logoUrl = (string) $setting->value;
        $this->assertSame('image', $setting->media_type);
        $this->assertSame('A1 Legacy Labs header logo', $setting->image_alt);
        $this->assertStringStartsWith('/media/neutron/', $logoUrl);
        $this->assertFileExists(storage_path('app/public/'.MediaStorage::managedRelativePath($logoUrl)));

        $settingsPage = $this->actingAs($admin)->get(route('admin.settings.index'));

        $settingsPage
            ->assertOk()
            ->assertSee('src="'.$logoUrl.'"', false);
        $this->assertGreaterThanOrEqual(3, substr_count($settingsPage->getContent(), 'src="'.$logoUrl.'"'));

        MediaStorage::deleteManaged($logoUrl);
    }

    public function test_admin_sidebar_renders_the_dynamic_header_logo(): void
    {
        $admin = User::factory()->admin()->create();
        SiteSetting::factory()->create(['key' => 'site_name', 'value' => 'A1 Legacy']);
        SiteSetting::factory()->create([
            'key' => 'header_logo',
            'group' => 'branding',
            'type' => 'image',
            'value' => '/media/neutron/current-logo.webp',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.settings.index'))
            ->assertOk()
            ->assertSee('src="/media/neutron/current-logo.webp"', false)
            ->assertSee('alt="A1 Legacy"', false);
    }
}
