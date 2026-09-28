<?php

namespace App\Support;

use App\Rules\SafeImageUpload;
use App\Rules\SafeVideoUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * Image storage helper that deliberately avoids Laravel/Flysystem MIME
 * detection. This keeps uploads working when PHP's fileinfo extension is
 * disabled (common on some local/shared hosting installations).
 */
class MediaStorage
{
    public static function storeImage(UploadedFile $file, string $directory = 'neutron'): string
    {
        $extension = SafeImageUpload::safeExtension($file);

        if ($extension === null) {
            throw new RuntimeException('The uploaded file is not a supported image.');
        }

        $directory = trim(str_replace('\\', '/', $directory), '/');
        if ($directory === '' || str_contains($directory, '..') || str_starts_with($directory, '.')) {
            $directory = 'neutron';
        }

        $sourcePath = $file->getRealPath();
        if (! is_string($sourcePath) || $sourcePath === '' || ! is_file($sourcePath) || ! is_readable($sourcePath)) {
            throw new RuntimeException('The uploaded temporary file is not readable.');
        }

        $filename = Str::uuid()->toString().'.'.$extension;
        $targetDirectory = storage_path('app/public/'.$directory);

        if (! is_dir($targetDirectory) && ! @mkdir($targetDirectory, 0755, true) && ! is_dir($targetDirectory)) {
            throw new RuntimeException('Unable to create the media directory.');
        }

        $targetPath = $targetDirectory.DIRECTORY_SEPARATOR.$filename;

        // COPY instead of UploadedFile::move(). Keeping PHP's temporary upload
        // alive until the request finishes prevents Symfony's exception renderer
        // from throwing a secondary "temporary file does not exist" exception.
        if (! @copy($sourcePath, $targetPath) || ! is_file($targetPath)) {
            @unlink($targetPath);
            throw new RuntimeException('Unable to copy the uploaded image.');
        }

        @chmod($targetPath, 0644);

        return '/media/'.$directory.'/'.$filename;
    }

    public static function storeSectionHtml(UploadedFile $file, string $directory = 'sections/html'): string
    {
        $extension = strtolower((string) $file->getClientOriginalExtension());
        if (! in_array($extension, ['html', 'htm'], true)) {
            throw new RuntimeException('The uploaded file is not a supported HTML section.');
        }

        $directory = trim(str_replace('\\', '/', $directory), '/');
        if ($directory === '' || str_contains($directory, '..') || str_starts_with($directory, '.')) {
            $directory = 'sections/html';
        }

        $sourcePath = $file->getRealPath();
        if (! is_string($sourcePath) || $sourcePath === '' || ! is_file($sourcePath) || ! is_readable($sourcePath)) {
            throw new RuntimeException('The uploaded temporary HTML section file is not readable.');
        }

        $contents = @file_get_contents($sourcePath);
        if (! is_string($contents) || trim($contents) === '') {
            throw new RuntimeException('The uploaded HTML section file is empty or unreadable.');
        }

        // Keep uploaded sections usable on phones/tablets even when the file
        // forgot basic responsive document defaults. This stays inside the
        // sandboxed iframe and does not touch the site CSS.
        if (! preg_match('/<meta[^>]+name=[\"\']viewport[\"\']/i', $contents)) {
            $viewport = '<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">';
            if (preg_match('/<head[^>]*>/i', $contents)) {
                $contents = preg_replace('/<head([^>]*)>/i', '<head$1>'.$viewport, $contents, 1) ?? ($viewport.$contents);
            } else {
                $contents = $viewport."\n".$contents;
            }
        }

        $responsiveCss = '<style id="a1-section-responsive-guard">html,body{max-width:100%;}body{margin-left:auto;margin-right:auto;}img,video,svg,canvas{max-width:100%;}iframe{max-width:100%;}</style>';
        if (preg_match('/<head[^>]*>/i', $contents)) {
            $contents = preg_replace('/<\/head\s*>/i', $responsiveCss."\n</head>", $contents, 1) ?? ($responsiveCss.$contents);
        } else {
            $contents = $responsiveCss."\n".$contents;
        }

        // The iframe is cross-origin sandboxed. This tiny bridge reports the
        // rendered height to the parent so the uploaded section can keep its
        // original layout without a fixed-height crop.
        $bridge = <<<'HTML'
<script>
(function(){
  function sendHeight(){
    var h=Math.max(document.documentElement.scrollHeight,document.body?document.body.scrollHeight:0);
    parent.postMessage({type:'a1-html-section-height',height:h},'*');
  }
  window.addEventListener('load',sendHeight);
  window.addEventListener('resize',sendHeight);
  if(window.ResizeObserver){new ResizeObserver(sendHeight).observe(document.documentElement);}
  setTimeout(sendHeight,50);setTimeout(sendHeight,500);setTimeout(sendHeight,1500);
})();
</script>
HTML;

        if (preg_match('/<\/body\s*>/i', $contents)) {
            $contents = preg_replace('/<\/body\s*>/i', $bridge."\n</body>", $contents, 1) ?? ($contents.$bridge);
        } else {
            $contents .= "\n".$bridge;
        }

        $filename = Str::uuid()->toString().'.html';
        $targetDirectory = storage_path('app/public/'.$directory);
        if (! is_dir($targetDirectory) && ! @mkdir($targetDirectory, 0755, true) && ! is_dir($targetDirectory)) {
            throw new RuntimeException('Unable to create the HTML section media directory.');
        }

        $targetPath = $targetDirectory.DIRECTORY_SEPARATOR.$filename;
        if (@file_put_contents($targetPath, $contents) === false || ! is_file($targetPath)) {
            @unlink($targetPath);
            throw new RuntimeException('Unable to save the uploaded HTML section.');
        }

        @chmod($targetPath, 0644);

        return '/media/'.$directory.'/'.$filename;
    }

    public static function storeAnimationHtml(UploadedFile $file, string $directory = 'animations'): string
    {
        $extension = strtolower((string) $file->getClientOriginalExtension());
        if (! in_array($extension, ['html', 'htm'], true)) {
            throw new RuntimeException('The uploaded file is not a supported HTML animation.');
        }

        $directory = trim(str_replace('\\', '/', $directory), '/');
        if ($directory === '' || str_contains($directory, '..') || str_starts_with($directory, '.')) {
            $directory = 'animations';
        }

        $sourcePath = $file->getRealPath();
        if (! is_string($sourcePath) || $sourcePath === '' || ! is_file($sourcePath) || ! is_readable($sourcePath)) {
            throw new RuntimeException('The uploaded temporary animation file is not readable.');
        }

        $filename = Str::uuid()->toString().'.html';
        $targetDirectory = storage_path('app/public/'.$directory);
        if (! is_dir($targetDirectory) && ! @mkdir($targetDirectory, 0755, true) && ! is_dir($targetDirectory)) {
            throw new RuntimeException('Unable to create the animation media directory.');
        }

        $targetPath = $targetDirectory.DIRECTORY_SEPARATOR.$filename;
        if (! @copy($sourcePath, $targetPath) || ! is_file($targetPath)) {
            @unlink($targetPath);
            throw new RuntimeException('Unable to copy the uploaded HTML animation.');
        }

        @chmod($targetPath, 0644);

        return '/media/'.$directory.'/'.$filename;
    }

    public static function storeVideo(UploadedFile $file, string $directory = 'client-stories'): string
    {
        $extension = SafeVideoUpload::safeExtension($file);
        if ($extension === null) {
            throw new RuntimeException('The uploaded file is not a supported video.');
        }
        $directory = trim(str_replace('\\', '/', $directory), '/');
        if ($directory === '' || str_contains($directory, '..') || str_starts_with($directory, '.')) {
            $directory = 'client-stories';
        }
        $sourcePath = $file->getRealPath();
        if (! is_string($sourcePath) || $sourcePath === '' || ! is_file($sourcePath) || ! is_readable($sourcePath)) {
            throw new RuntimeException('The uploaded temporary file is not readable.');
        }
        $filename = Str::uuid()->toString().'.'.$extension;
        $targetDirectory = storage_path('app/public/'.$directory);
        if (! is_dir($targetDirectory) && ! @mkdir($targetDirectory, 0755, true) && ! is_dir($targetDirectory)) {
            throw new RuntimeException('Unable to create the media directory.');
        }
        $targetPath = $targetDirectory.DIRECTORY_SEPARATOR.$filename;
        if (! @copy($sourcePath, $targetPath) || ! is_file($targetPath)) {
            @unlink($targetPath);
            throw new RuntimeException('Unable to copy the uploaded video.');
        }
        @chmod($targetPath, 0644);

        return '/media/'.$directory.'/'.$filename;
    }

    public static function deleteManaged(?string $url): void
    {
        $relativePath = self::managedRelativePath($url);
        if ($relativePath === null) {
            return;
        }

        $root = storage_path('app/public');
        $candidate = $root.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

        if (! is_file($candidate)) {
            return;
        }

        // Resolve both paths and ensure a crafted URL can never escape the
        // public media root before deleting anything.
        $realRoot = realpath($root);
        $realFile = realpath($candidate);
        if ($realRoot === false || $realFile === false) {
            return;
        }

        $rootPrefix = rtrim($realRoot, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        if (! str_starts_with($realFile, $rootPrefix)) {
            return;
        }

        @unlink($realFile);
    }

    public static function managedRelativePath(?string $url): ?string
    {
        if (! is_string($url) || trim($url) === '') {
            return null;
        }

        $path = parse_url($url, PHP_URL_PATH);
        if (! is_string($path) || $path === '') {
            $path = $url;
        }

        $relativePath = null;
        foreach (['/media/', '/storage/'] as $prefix) {
            if (str_starts_with($path, $prefix)) {
                $relativePath = substr($path, strlen($prefix));
                break;
            }
        }

        if ($relativePath === null) {
            return null;
        }

        $relativePath = ltrim(str_replace('\\', '/', rawurldecode($relativePath)), '/');

        if (
            $relativePath === ''
            || str_contains($relativePath, '..')
            || str_contains($relativePath, "\0")
            || str_starts_with($relativePath, '.')
            || ! preg_match('/\.(?:jpe?g|png|webp|gif|avif|mp4|webm|html?)$/i', $relativePath)
        ) {
            return null;
        }

        return $relativePath;
    }
}
