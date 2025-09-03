<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lainnya_konten_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lainnya_konten_id')->constrained('lainnya_konten')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->json('photos')->nullable();
            $table->json('videos')->nullable();
            $table->json('files')->nullable();
            $table->json('videos_link')->nullable()->comment('Array link video platform');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lainnya_konten_blocks');
    }
};
