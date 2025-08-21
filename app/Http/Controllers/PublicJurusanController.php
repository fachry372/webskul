<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use HTMLPurifier_Config;
use HTMLPurifier;

class PublicJurusanController extends Controller
{
    /**
     * Tampilkan detail jurusan berdasarkan slug.
     */
    public function showByJurusan($slug)
    {
        // 1. Ambil data jurusan berdasarkan slug dari database
        $jurusan = Jurusan::where('slug', $slug)->firstOrFail();

        // 2. Ambil data post yang terkait dengan jurusan ini
        $posts = Post::where('jurusan_id', $jurusan->id)->latest()->get();

        // 3. Siapkan data menu kompetensi keahlian secara dinamis
        $jurusans = Jurusan::all();
        $kompetensiKeahlian = $jurusans->mapWithKeys(function ($jurusan) {
            return [$jurusan->name => route('jurusan.show', Str::slug($jurusan->name))];
        })->toArray();

        // 4. Proses dan bersihkan konten post (logika yang sudah Anda sediakan)
        $sections = [
            'description', 'kompetensi_dasar', 'tujuan_pembelajaran', 'kurikulum_sinkronisasi',
            'program_unggulan', 'tim_pengajar', 'galeri_kegiatan', 'kundudi', 'industri_pasangan'
        ];

        foreach ($posts as $post) {
            foreach ($sections as $section) {
                if (!empty($post->$section)) {
                    $post->$section = $this->rebuildAndCleanContent($post->$section);
                }
            }
        }

        // 5. Tentukan nama view berdasarkan slug
        $viewName = 'public.jurusan.' . str_replace('-', '_', $jurusan->slug);

        if (!view()->exists($viewName)) {
            abort(404, 'View untuk jurusan ini tidak ditemukan.');
        }

        // 6. Kirim semua data yang dibutuhkan ke view
        return view($viewName, compact('jurusan', 'posts', 'sections', 'kompetensiKeahlian'));
    }
    /**
     * Membersihkan dan menambahkan kelas CSS ke konten HTML.
     */
    private function rebuildAndCleanContent($html)
    {
        $config = HTMLPurifier_Config::createDefault();

        $config->set('HTML.Doctype', 'HTML 4.01 Transitional');

        $config->set('HTML.Allowed', 'p,br,b,i,u,strike,ul,ol,li,h1,h2,h3,h4,h5,h6,div[class|style],a[href],img[src|alt|style|width|height|class],figure,figcaption');
        $config->set('CSS.AllowedProperties', 'text-align,float,margin-left,margin-right,display,list-style-type');
        $config->set('AutoFormat.AutoParagraph', false);
        $config->set('AutoFormat.RemoveEmpty', false);

        $def = $config->getHTMLDefinition(true);

        // Perbaikan: Ganti 'CSS.Text' dengan 'Text'
        $def->addElement(
            'figure',
            'Block',
            'Flow',
            'Common',
            ['class' => 'Text']
        );
        $def->addElement(
            'figcaption',
            'Block',
            'Inline',
            'Common'
        );

        $purifier = new HTMLPurifier($config);

        $purifiedHtml = $purifier->purify($html);

        $purifiedHtml = preg_replace('/<p[^>]*>[\s\p{Z}]*<br\s*\/?>[\s\p{Z}]*<\/p>/u', '', $purifiedHtml);
        $purifiedHtml = preg_replace('/<p[^>]*>[\s\p{Z}]*<\/p>/u', '', $purifiedHtml);
        $purifiedHtml = preg_replace('/<div[^>]*>[\s\p{Z}]*<\/div>/u', '', $purifiedHtml);

        $replacements = [
            '<h1' => '<h1 class="font-semibold mt-4 mb-2 text-gray-800"',
            '<h2' => '<h2 class="font-semibold mt-4 mb-2 text-gray-800"',
            '<h3' => '<h3 class="font-semibold mt-4 mb-2 text-gray-800"',
            '<h4' => '<h4 class="font-semibold mt-4 mb-2 text-gray-800"',
            '<h5' => '<h5 class="font-semibold mt-4 mb-2 text-gray-800"',
            '<h6' => '<h6 class="font-semibold mt-4 mb-2 text-gray-800"',
            '<ul' => '<ul class="list-disc pl-5 mb-2"',
            '<ol' => '<ol class="list-decimal pl-5 mb-2"',
            '<li' => '<li class="mb-1"',
            '<figure' => '<figure class="max-w-md mx-auto"',
            '<figcaption' => '<figcaption class="mt-2 text-sm text-center text-gray-500"',
            '<img' => '<img loading="lazy" class="rounded shadow max-w-full mx-auto mb-4"',
        ];

        return str_ireplace(array_keys($replacements), array_values($replacements), $purifiedHtml);
    }

    public function getJurusanMenu()
    {
        $jurusans = Jurusan::all();
        $kompetensiKeahlian = $jurusans->mapWithKeys(function ($jurusan) {
            return [$jurusan->name => route('jurusan.show', Str::slug($jurusan->name))];
        })->toArray();

        return $kompetensiKeahlian;
    }
}