<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Schema;

final class SmtpConfiguration
{
    public const PASSWORD_KEY = 'smtp_password';

    private const SETTING_KEYS = [
        'smtp_enabled',
        'smtp_host',
        'smtp_port',
        'smtp_encryption',
        'smtp_username',
        self::PASSWORD_KEY,
        'smtp_from_address',
        'smtp_from_name',
    ];

    /** @var array{default: mixed, smtp: mixed, from: mixed} */
    private array $fallbackConfiguration;

    public function __construct(
        private readonly Repository $config,
        private readonly Encrypter $encrypter,
    ) {
        $this->fallbackConfiguration = [
            'default' => $this->config->get('mail.default'),
            'smtp' => $this->config->get('mail.mailers.smtp'),
            'from' => $this->config->get('mail.from'),
        ];
    }

    public function applyFromDatabase(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        $settings = SiteSetting::query()
            ->whereIn('key', self::SETTING_KEYS)
            ->pluck('value', 'key')
            ->all();

        if (! filter_var($settings['smtp_enabled'] ?? false, FILTER_VALIDATE_BOOL)) {
            $this->restoreFallbackConfiguration();

            return;
        }

        $host = trim((string) ($settings['smtp_host'] ?? ''));
        $fromAddress = trim((string) ($settings['smtp_from_address'] ?? ''));

        if ($host === '' || $fromAddress === '') {
            $this->restoreFallbackConfiguration();

            return;
        }

        $encryption = $settings['smtp_encryption'] ?? 'tls';
        $port = filter_var(
            $settings['smtp_port'] ?? 587,
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1, 'max_range' => 65535]],
        ) ?: 587;

        $this->config->set([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.url' => null,
            'mail.mailers.smtp.scheme' => $encryption === 'ssl' ? 'smtps' : 'smtp',
            'mail.mailers.smtp.host' => $host,
            'mail.mailers.smtp.port' => $port,
            'mail.mailers.smtp.username' => $this->nullableString($settings['smtp_username'] ?? null),
            'mail.mailers.smtp.password' => $this->decryptPassword($settings[self::PASSWORD_KEY] ?? null),
            'mail.mailers.smtp.auto_tls' => $encryption !== 'none',
            'mail.from.address' => $fromAddress,
            'mail.from.name' => trim((string) ($settings['smtp_from_name'] ?? '')),
        ]);
    }

    public function encryptPassword(string $password): string
    {
        return $this->encrypter->encryptString($password);
    }

    private function decryptPassword(?string $password): ?string
    {
        if ($password === null || $password === '') {
            return null;
        }

        try {
            return $this->encrypter->decryptString($password);
        } catch (DecryptException) {
            return null;
        }
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    private function restoreFallbackConfiguration(): void
    {
        $this->config->set([
            'mail.default' => $this->fallbackConfiguration['default'],
            'mail.mailers.smtp' => $this->fallbackConfiguration['smtp'],
            'mail.from' => $this->fallbackConfiguration['from'],
        ]);
    }
}
