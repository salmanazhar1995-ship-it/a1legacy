<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

/**
 * Validates self-contained HTML animation uploads without relying on fileinfo.
 * The public media controller serves these files with a CSP sandbox, so inline
 * animation scripts can run without receiving same-origin access to the site.
 */
class SafeAnimationHtmlUpload implements ValidationRule
{
    public function __construct(private readonly int $maxKilobytes = 5120) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value instanceof UploadedFile || ! $value->isValid()) {
            $fail('Please upload a valid HTML animation file.');

            return;
        }

        $extension = strtolower((string) $value->getClientOriginalExtension());
        if (! in_array($extension, ['html', 'htm'], true)) {
            $fail('The animation must be an .html or .htm file.');

            return;
        }

        $size = $value->getSize();
        if (is_int($size) && $size > $this->maxKilobytes * 1024) {
            $fail('The animation HTML file may not be larger than '.($this->maxKilobytes / 1024).' MB.');

            return;
        }

        $path = $value->getRealPath();
        if (! is_string($path) || $path === '' || ! is_file($path) || ! is_readable($path)) {
            $fail('The uploaded animation file could not be read.');

            return;
        }

        $contents = @file_get_contents($path, false, null, 0, min((int) ($size ?: 262144), 262144));
        if (! is_string($contents) || trim($contents) === '') {
            $fail('The uploaded animation HTML file is empty or unreadable.');

            return;
        }

        // Server-side executable templates are never accepted. JavaScript is
        // allowed because the file is served in a browser sandbox.
        if (preg_match('/<\?(?:php|=)|<%|\b(?:include|require)_once\s*\(/i', $contents)) {
            $fail('Server-side executable code is not allowed in animation HTML uploads.');

            return;
        }

        if (! preg_match('/<(?:!doctype\s+html|html|svg|canvas|body|div)\b/i', $contents)) {
            $fail('The file does not look like a valid HTML animation document.');
        }
    }
}
