<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingsRequest;
use App\Models\SiteSetting;
use App\Support\MediaStorage;
use App\Support\SmtpConfiguration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class SiteSettingController extends Controller
{
    public function index(): View
    {
        $settingGroups = SiteSetting::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->groupBy('group');

        return view('admin.settings.index', compact('settingGroups'));
    }

    public function update(UpdateSiteSettingsRequest $request, SmtpConfiguration $smtpConfiguration): RedirectResponse
    {
        $validated = $request->validated();
        $submittedSettings = $validated['settings'] ?? [];
        $mediaTypes = $validated['setting_media_types'] ?? [];
        $imageAlts = $validated['setting_image_alts'] ?? [];
        $removeImages = $validated['remove_setting_images'] ?? [];
        $removeAnimations = $validated['remove_setting_animations'] ?? [];
        $allSettings = SiteSetting::query()->orderBy('id')->get();

        // Validate media mode requirements before changing any database values.
        // This prevents a later media validation error from leaving earlier settings partially updated.
        foreach ($allSettings as $setting) {
            $isMediaSetting = $setting->group === 'media' || $setting->type === 'image';
            if (! $isMediaSetting) {
                continue;
            }

            $mediaType = $mediaTypes[$setting->key] ?? ($setting->media_type ?: 'image');
            $removeImage = (bool) ($removeImages[$setting->key] ?? false);
            $removeAnimation = (bool) ($removeAnimations[$setting->key] ?? false);
            $hasNewImage = $request->hasFile("setting_files.{$setting->key}");
            $hasNewAnimation = $request->hasFile("setting_animation_files.{$setting->key}");
            $willHaveImage = $hasNewImage || (! $removeImage && filled($setting->value));
            $willHaveAnimation = $hasNewAnimation || (! $removeAnimation && filled($setting->animation_html_url));
            $imageAlt = trim((string) ($imageAlts[$setting->key] ?? $setting->image_alt ?? ''));

            if ($mediaType === 'image' && $willHaveImage && $imageAlt === '') {
                throw ValidationException::withMessages([
                    "setting_image_alts.{$setting->key}" => 'Image ALT text is required whenever an image is used.',
                ]);
            }

            if ($mediaType === 'animation' && ! $willHaveAnimation) {
                throw ValidationException::withMessages([
                    "setting_animation_files.{$setting->key}" => 'Upload an HTML animation when HTML animation is selected.',
                ]);
            }
        }

        foreach ($allSettings as $setting) {
            if (array_key_exists($setting->key, $submittedSettings)) {
                $value = $submittedSettings[$setting->key];

                if ($setting->key === SmtpConfiguration::PASSWORD_KEY) {
                    if ($value !== null && $value !== '') {
                        $setting->update(['value' => $smtpConfiguration->encryptPassword($value)]);
                    }
                } else {
                    $setting->update(['value' => $value]);
                }
            }

            $isMediaSetting = $setting->group === 'media' || $setting->type === 'image';
            if (! $isMediaSetting) {
                continue;
            }

            $mediaType = $mediaTypes[$setting->key] ?? ($setting->media_type ?: 'image');
            $removeImage = (bool) ($removeImages[$setting->key] ?? false);
            $removeAnimation = (bool) ($removeAnimations[$setting->key] ?? false);
            $hasNewImage = $request->hasFile("setting_files.{$setting->key}");
            $hasNewAnimation = $request->hasFile("setting_animation_files.{$setting->key}");
            $imageAlt = trim((string) ($imageAlts[$setting->key] ?? $setting->image_alt ?? ''));

            if ($removeImage) {
                MediaStorage::deleteManaged($setting->value);
                $setting->value = null;
                $setting->image_alt = null;
            }

            if ($removeAnimation) {
                MediaStorage::deleteManaged($setting->animation_html_url);
                $setting->animation_html_url = null;
            }

            if ($hasNewImage) {
                try {
                    $newImageUrl = MediaStorage::storeImage($request->file("setting_files.{$setting->key}"), 'site-settings');
                } catch (RuntimeException $exception) {
                    report($exception);
                    return back()->withInput($request->except('settings.smtp_password'))->withErrors([
                        "setting_files.{$setting->key}" => 'The image could not be saved. Check the storage/app/public folder permissions and try again.',
                    ]);
                }
                MediaStorage::deleteManaged($setting->value);
                $setting->value = $newImageUrl;
            }

            if ($hasNewAnimation) {
                try {
                    $newAnimationUrl = MediaStorage::storeAnimationHtml($request->file("setting_animation_files.{$setting->key}"), 'site-settings/animations');
                } catch (RuntimeException $exception) {
                    report($exception);
                    return back()->withInput($request->except('settings.smtp_password'))->withErrors([
                        "setting_animation_files.{$setting->key}" => 'The HTML animation could not be saved. Check the file and storage permissions and try again.',
                    ]);
                }
                MediaStorage::deleteManaged($setting->animation_html_url);
                $setting->animation_html_url = $newAnimationUrl;
                $mediaType = 'animation';
            }

            $setting->media_type = $mediaType;
            if ($imageAlt !== '' && $setting->value) {
                $setting->image_alt = $imageAlt;
            } elseif (! $setting->value) {
                $setting->image_alt = null;
            }
            $setting->save();
        }

        $smtpConfiguration->applyFromDatabase();
        Mail::forgetMailers();

        return back()->with('success', 'Site settings updated.');
    }
}
