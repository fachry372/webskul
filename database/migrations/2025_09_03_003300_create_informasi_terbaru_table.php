<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('informasi_terbaru', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi');
            $table->foreignId('kategori_id')->constrained('kategori_informasi')->onDelete('cascade');
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->date('tanggal_publish')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('informasi_terbaru');
    }
};
