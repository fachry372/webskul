<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('renderFiles')) {
    /**
     * Render file list sebagai link download dan scrollable preview (jika PDF atau teks).
     *
     * @param array $files
     * @return string
     */
    function renderFiles(array $files = [])
    {
        $html = '';
        foreach ($files as $file) {
            $url = Storage::url($file);
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            $html .= '<div class="mb-4">';
            if (in_array($ext, ['pdf', 'txt'])) {
                $html .= "<iframe src=\"$url\" style=\"width:100%;height:400px;border:1px solid #ccc;border-radius:6px;\"></iframe>";
            }
            $html .= "<a href=\"$url\" class=\"download-btn\" download>Download File</a>";
            $html .= '</div>';
        }
        return $html;
    }
}

if (!function_exists('renderVideos')) {
    /**
     * Render video list baik dari storage maupun link eksternal.
     *
     * @param array $videos
     * @return string
     */
    function renderVideos(array $videos = [])
    {
        $html = '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">';
        foreach ($videos as $video) {
            if (filter_var($video, FILTER_VALIDATE_URL)) {
                // Link eksternal: YouTube, TikTok, IG, Facebook
                if (str_contains($video, 'youtube.com') || str_contains($video, 'youtu.be')) {
                    preg_match("/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/", $video, $matches);
                    $id = $matches[1] ?? '';
                    $embed = "https://www.youtube.com/embed/$id";
                    $html .= "<iframe class=\"w-full rounded-lg shadow\" height=\"250\" src=\"$embed\" frameborder=\"0\" allowfullscreen></iframe>";
                } elseif (str_contains($video, 'tiktok.com')) {
                    $html .= "<iframe class=\"w-full rounded-lg shadow\" height=\"400\" src=\"$video\" frameborder=\"0\" allowfullscreen></iframe>";
                } else {
                    // fallback: tampilkan link
                    $html .= "<a href=\"$video\" target=\"_blank\" class=\"download-btn\">Buka Video</a>";
                }
            } else {
                // File lokal
                $url = Storage::url($video);
                $html .= "<video src=\"$url\" controls class=\"w-full rounded-lg shadow\"></video>";
            }
        }
        $html .= '</div>';
        return $html;
    }
}

if (!function_exists('renderPhotos')) {
    /**
     * Render foto sebagai grid gallery.
     *
     * @param array $photos
     * @return string
     */
    function renderPhotos(array $photos = [])
    {
        $html = '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">';
        foreach ($photos as $photo) {
            $url = Storage::url($photo);
            $html .= "<img src=\"$url\" alt=\"Foto IKM\" class=\"gallery-image\" loading=\"lazy\">";
        }
        $html .= '</div>';
        return $html;
    }






    if (!function_exists('convertVideoLink')) {
        function convertVideoLink($url)
        {
            // pastikan input string
            if (!is_string($url)) {
                return null;
            }

            // YouTube watch?v=
            if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
                return 'https://www.youtube.com/embed/' . $id[1];
            }

            // YouTube short youtu.be
            if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
                return 'https://www.youtube.com/embed/' . $id[1];
            }

            // Vimeo
            if (preg_match('/vimeo\.com\/(\d+)/', $url, $id)) {
                return 'https://player.vimeo.com/video/' . $id[1];
            }

            // Default → kembalikan original url
            return $url;
        }
    }



}
