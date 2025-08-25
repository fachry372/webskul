<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profile_id')
                  ->constrained('profiles')
                  ->onDelete('cascade'); // relasi ke table profiles

            $table->string('title'); // sesuai struktur sebelumnya, varchar(255)
            $table->text('content')->nullable(); // isi konten
            $table->string('image')->nullable(); // gambar utama

            // Tambahan untuk mendukung multiple photos & files seperti fitur Tambah Post
            $table->json('content_section_photos')->nullable(); // array foto
            $table->text('content_section_photos_text')->nullable(); // teks di bawah foto
            $table->json('content_section_files')->nullable(); // array file

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
