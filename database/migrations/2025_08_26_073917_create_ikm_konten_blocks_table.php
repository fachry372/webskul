<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ikm_konten_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ikm_konten_id')->constrained('ikm_konten')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->json('photos')->nullable();
            $table->json('videos')->nullable();
            $table->json('files')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikm_konten_blocks');
    }
};
