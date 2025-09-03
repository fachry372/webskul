<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('informasi_terbaru_gambar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informasi_id')->constrained('informasi_terbaru')->onDelete('cascade');
            $table->string('nama_file');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('informasi_terbaru_gambar');
    }
};
