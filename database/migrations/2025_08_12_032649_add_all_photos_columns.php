<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->json('description_photos')->nullable()->after('description');
            $table->json('kompetensi_dasar_photos')->nullable()->after('kompetensi_dasar');
            $table->json('tujuan_pembelajaran_photos')->nullable()->after('tujuan_pembelajaran');
            $table->json('kurikulum_sinkronisasi_photos')->nullable()->after('kurikulum_sinkronisasi');
            $table->json('program_unggulan_photos')->nullable()->after('program_unggulan');
            $table->json('kundudi_photos')->nullable()->after('kundudi');
            $table->json('industri_pasangan_photos')->nullable()->after('industri_pasangan');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'description_photos',
                'kompetensi_dasar_photos',
                'tujuan_pembelajaran_photos',
                'kurikulum_sinkronisasi_photos',
                'program_unggulan_photos',
                'kundudi_photos',
                'industri_pasangan_photos'
            ]);
        });
    }
};
