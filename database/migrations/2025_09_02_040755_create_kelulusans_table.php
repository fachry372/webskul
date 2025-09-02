<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kelulusans', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->unique(); // Judul kelulusan
            $table->string('slug')->unique();  // Slug otomatis
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelulusans');
    }
};
