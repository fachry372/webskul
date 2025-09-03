<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lainnya_konten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lainnya_id')->constrained('lainnya')->onDelete('cascade');
            $table->string('title');
            $table->text('text')->nullable();
            $table->json('photos')->nullable();
            $table->json('videos')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lainnya_konten');
    }
};
