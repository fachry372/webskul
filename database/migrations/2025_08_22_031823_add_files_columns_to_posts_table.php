<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->json('description_files')->nullable()->after('description');
            $table->json('kompetensi_dasar_files')->nullable()->after('kompetensi_dasar');
            $table->json('tujuan_pembelajaran_files')->nullable()->after('tujuan_pembelajaran');
            $table->json('kurikulum_sinkronisasi_files')->nullable()->after('kurikulum_sinkronisasi');
            $table->json('program_unggulan_files')->nullable()->after('program_unggulan');
            $table->json('tim_pengajar_files')->nullable()->after('tim_pengajar');
            $table->json('galeri_kegiatan_files')->nullable()->after('galeri_kegiatan');
            $table->json('kundudi_files')->nullable()->after('kundudi');
            $table->json('industri_pasangan_files')->nullable()->after('industri_pasangan');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'description_files',
                'kompetensi_dasar_files',
                'tujuan_pembelajaran_files',
                'kurikulum_sinkronisasi_files',
                'program_unggulan_files',
                'tim_pengajar_files',
                'galeri_kegiatan_files',
                'kundudi_files',
                'industri_pasangan_files',
            ]);
        });
    }
};
