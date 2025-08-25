<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Judul isi
            $table->text('content')->nullable(); // Isi konten
            $table->string('image')->nullable(); // Opsi upload gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_items');
    }
};
