<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ikm_konten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ikm_id')->constrained('ikms')->onDelete('cascade'); // relasi ke tabel ikms
            $table->string('title');
            $table->text('text')->nullable();
            $table->json('photos')->nullable(); // simpan multiple foto dalam bentuk JSON
            $table->json('videos')->nullable(); // simpan multiple video dalam bentuk JSON
            $table->string('file')->nullable(); // 1 file upload (pdf/docx/dll)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikm_konten');
    }
};
