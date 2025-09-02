<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kelulusan_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelulusan_id')->constrained('kelulusans')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->json('photos')->nullable();
            $table->json('videos')->nullable();
            $table->json('videos_link')->nullable()->comment('Array link video platform (YT, TikTok, IG, FB, dll)');
            $table->json('files')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelulusan_blocks');
    }
};
