<?php

namespace App\Helpers;

class VideoHelper
{
    /**
     * Convert video URL menjadi link embed untuk iframe
     */
    public static function convert(string $url): ?string
    {
        // YouTube
        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w-]+)/', $url, $matches);
            $id = $matches[1] ?? null;
            return $id ? "https://www.youtube.com/embed/$id" : null;
        }

        // TikTok
        if (strpos($url, 'tiktok.com') !== false) {
            $url = preg_replace('/\/(@[\w\.-]+\/video\/\d+).*/', '$1', $url);
            return "https://www.tiktok.com/embed" . $url;
        }

        // Instagram
        if (strpos($url, 'instagram.com') !== false) {
            return rtrim($url, '/') . '/embed';
        }

        // Facebook
        if (strpos($url, 'facebook.com') !== false) {
            return "https://www.facebook.com/plugins/video.php?href=" . urlencode($url);
        }

        // Default return original
        return $url;
    }
}
