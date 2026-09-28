<?php

namespace App\Support;

final class RichText
{
    /**
     * Keep a conservative set of formatting tags while stripping scripts,
     * inline event handlers and javascript: URLs. This avoids requiring extra
     * PHP extensions/packages on shared hosting.
     */
    public static function sanitize(?string $html): ?string
    {
        if ($html === null) {
            return null;
        }

        $html = trim($html);
        if ($html === '') {
            return null;
        }

        $allowed = '<p><br><h2><h3><h4><h5><h6><strong><b><em><i><u><ul><ol><li><blockquote><a><table><thead><tbody><tr><th><td><hr>';
        $html = strip_tags($html, $allowed);

        // Strip inline event handlers and style attributes.
        $html = preg_replace('/\s+on[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html) ?? $html;
        $html = preg_replace('/\s+style\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html) ?? $html;

        // Remove dangerous URL schemes from href/src-like attributes.
        $html = preg_replace_callback('/\s+(href|src)\s*=\s*(["\'])(.*?)\2/i', static function (array $m): string {
            $value = trim($m[3]);
            if (preg_match('/^(javascript|data|vbscript):/i', $value)) {
                return '';
            }

            return ' '.$m[1].'='.$m[2].htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8').$m[2];
        }, $html) ?? $html;

        return trim($html) ?: null;
    }

    public static function render(?string $html): string
    {
        $html = self::sanitize($html);
        if ($html === null) {
            return '';
        }

        // Legacy content in this project was plain text. Preserve its line breaks.
        if ($html === strip_tags($html)) {
            return nl2br(htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
        }

        return $html;
    }
}
