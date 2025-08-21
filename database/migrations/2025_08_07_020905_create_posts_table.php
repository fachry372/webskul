<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('kompetensi_dasar')->nullable();
            $table->text('tujuan_pembelajaran')->nullable();
            $table->text('kurikulum_sinkronisasi')->nullable();
            $table->text('program_unggulan')->nullable();
            $table->text('tim_pengajar')->nullable();
            $table->text('galeri_kegiatan')->nullable();
            $table->text('kundudi')->nullable();
            $table->text('industri_pasangan')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
