<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ikm_konten_blocks', function (Blueprint $table) {
            $table->json('videos_link')->nullable()->after('videos')->comment('Array link video platform (YT, TikTok, IG, FB, dll)');
        });
    }

    public function down(): void
    {
        Schema::table('ikm_konten_blocks', function (Blueprint $table) {
            $table->dropColumn('videos_link');
        });
    }
};
