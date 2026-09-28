<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

/**
 * Validates supported image uploads without PHP's fileinfo extension.
 *
 * Laravel's image/mimes rules and UploadedFile::extension() can depend on
 * Symfony MIME guessers. Some shared/local PHP installations have fileinfo
 * disabled, so this rule validates file size, extension and magic bytes
 * directly instead.
 */
class SafeImageUpload implements ValidationRule
{
    public const MAX_BYTES = 5 * 1024 * 1024;

    /** @var array<string, string> */
    private const EXTENSIONS = [
        'jpg' => 'jpg',
        'jpeg' => 'jpg',
        'png' => 'png',
        'webp' => 'webp',
        'avif' => 'avif',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value instanceof UploadedFile || ! $value->isValid()) {
            $fail('The :attribute must be a valid uploaded image.');

            return;
        }

        $size = $value->getSize();
        if ($size === false || $size <= 0 || $size > self::MAX_BYTES) {
            $fail('The :attribute must be an image no larger than 5 MB.');

            return;
        }

        if (self::safeExtension($value) === null) {
            $fail('The :attribute must be a JPG, PNG, WebP, or AVIF image.');
        }
    }

    /**
     * Return a trusted normalized extension after checking both the client
     * filename extension and the image file signature. No MIME guesser used.
     */
    public static function safeExtension(UploadedFile $file): ?string
    {
        $clientExtension = strtolower((string) $file->getClientOriginalExtension());
        $extension = self::EXTENSIONS[$clientExtension] ?? null;

        if ($extension === null) {
            return null;
        }

        $path = $file->getRealPath();
        if (! is_string($path) || $path === '' || ! is_file($path) || ! is_readable($path)) {
            return null;
        }

        $handle = @fopen($path, 'rb');
        if ($handle === false) {
            return null;
        }

        try {
            $header = (string) fread($handle, 64);
        } finally {
            fclose($handle);
        }

        if ($header === '') {
            return null;
        }

        return self::signatureMatches($extension, $header) ? $extension : null;
    }

    private static function signatureMatches(string $extension, string $header): bool
    {
        return match ($extension) {
            'jpg' => str_starts_with($header, "\xFF\xD8\xFF"),
            'png' => str_starts_with($header, "\x89PNG\r\n\x1A\n"),
            'webp' => strlen($header) >= 12
                && substr($header, 0, 4) === 'RIFF'
                && substr($header, 8, 4) === 'WEBP',
            'avif' => strlen($header) >= 16
                && substr($header, 4, 4) === 'ftyp'
                && (str_contains(substr($header, 8), 'avif') || str_contains(substr($header, 8), 'avis')),
            default => false,
        };
    }
}
