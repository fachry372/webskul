<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lainnya', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique(); // judul menu lainnya
            $table->string('slug')->unique();  // slug otomatis
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lainnya');
    }
};
