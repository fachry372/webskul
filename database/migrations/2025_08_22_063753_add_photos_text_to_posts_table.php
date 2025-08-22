<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $sections = [
                'description',
                'kompetensi_dasar',
                'tujuan_pembelajaran',
                'kurikulum_sinkronisasi',
                'program_unggulan',
                'tim_pengajar',
                'galeri_kegiatan',
                'kundudi',
                'industri_pasangan',
            ];

            foreach ($sections as $section) {
                $table->json($section . '_photos_text')->nullable()->after($section . '_photos');
            }
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $sections = [
                'description',
                'kompetensi_dasar',
                'tujuan_pembelajaran',
                'kurikulum_sinkronisasi',
                'program_unggulan',
                'tim_pengajar',
                'galeri_kegiatan',
                'kundudi',
                'industri_pasangan',
            ];

            foreach ($sections as $section) {
                $table->dropColumn($section . '_photos_text');
            }
        });
    }
};
