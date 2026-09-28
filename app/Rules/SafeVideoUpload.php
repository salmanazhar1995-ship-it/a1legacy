<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class SafeVideoUpload implements ValidationRule
{
    public const MAX_BYTES = 80 * 1024 * 1024;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value instanceof UploadedFile || ! $value->isValid()) {
            $fail('The :attribute must be a valid uploaded video.');

            return;
        }
        $size = $value->getSize();
        if ($size === false || $size <= 0 || $size > self::MAX_BYTES) {
            $fail('The :attribute must be no larger than 80 MB.');

            return;
        }
        if (self::safeExtension($value) === null) {
            $fail('The :attribute must be an MP4 or WebM video.');
        }
    }

    public static function safeExtension(UploadedFile $file): ?string
    {
        $ext = strtolower((string) $file->getClientOriginalExtension());
        if (! in_array($ext, ['mp4', 'webm'], true)) {
            return null;
        }
        $path = $file->getRealPath();
        if (! is_string($path) || $path === '' || ! is_file($path) || ! is_readable($path)) {
            return null;
        }
        $h = @fopen($path, 'rb');
        if ($h === false) {
            return null;
        } try {
            $header = (string) fread($h, 64);
        } finally {
            fclose($h);
        } if ($header === '') {
            return null;
        }
        $ok = $ext === 'mp4' ? (strlen($header) >= 12 && substr($header, 4, 4) === 'ftyp') : str_starts_with($header, "\x1A\x45\xDF\xA3");

        return $ok ? $ext : null;
    }
}
