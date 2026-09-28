<?php

namespace App\Http\Controllers;

use App\Support\MediaStorage;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Serves CMS images without Storage/Flysystem or Symfony MIME guessing.
 * This intentionally works even when the PHP fileinfo extension is disabled.
 */
class PublicMediaController extends Controller
{
    /** @var array<string, string> */
    private const CONTENT_TYPES = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'webp' => 'image/webp',
        'gif' => 'image/gif',
        'avif' => 'image/avif',
        'mp4' => 'video/mp4',
        'webm' => 'video/webm',
        'html' => 'text/html; charset=UTF-8',
        'htm' => 'text/html; charset=UTF-8',
    ];

    public function __invoke(string $path): StreamedResponse|Response
    {
        // Reuse the same strict path parser used for managed media URLs.
        $relativePath = MediaStorage::managedRelativePath('/media/'.ltrim($path, '/'));
        abort_if($relativePath === null, 404);

        $root = storage_path('app/public');
        $candidate = $root.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

        abort_unless(is_file($candidate) && is_readable($candidate), 404);

        $realRoot = realpath($root);
        $realFile = realpath($candidate);
        abort_if($realRoot === false || $realFile === false, 404);

        $rootPrefix = rtrim($realRoot, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        abort_unless(str_starts_with($realFile, $rootPrefix), 404);

        $extension = strtolower(pathinfo($realFile, PATHINFO_EXTENSION));
        $contentType = self::CONTENT_TYPES[$extension] ?? 'application/octet-stream';
        $size = @filesize($realFile);

        $headers = [
            'Content-Type' => $contentType,
            'Cache-Control' => 'public, max-age=86400',
            'X-Content-Type-Options' => 'nosniff',
        ];

        if (in_array($extension, ['html', 'htm'], true)) {
            // HTML animations are intentionally isolated from the main site.
            // Scripts may run for canvas/SVG/Lottie-style effects, but the
            // sandbox gives them an opaque origin and blocks parent access.
            $headers['Content-Security-Policy'] = "sandbox allow-scripts; default-src 'none'; script-src 'unsafe-inline' https:; style-src 'unsafe-inline' https:; img-src data: blob: https:; font-src data: https:; media-src data: blob: https:; connect-src https:; frame-src https:";
            $headers['Referrer-Policy'] = 'no-referrer';
        }

        if (is_int($size) || is_float($size)) {
            $headers['Content-Length'] = (string) $size;
        }

        return response()->stream(static function () use ($realFile): void {
            $stream = @fopen($realFile, 'rb');
            if ($stream === false) {
                return;
            }

            try {
                fpassthru($stream);
            } finally {
                fclose($stream);
            }
        }, 200, $headers);
    }
}
