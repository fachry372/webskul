<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriBlock extends Model
{
    use HasFactory;

    protected $table = 'galeri_blocks';

    protected $fillable = [
        'galeri_id',
        'title',
        'text',
        'photos',
        'videos',
        'videos_link',
        'files',
    ];

    protected $casts = [
        'photos' => 'array',
        'videos' => 'array',
        'videos_link' => 'array',
        'files' => 'array',
    ];

    // Relasi: Block belongsTo Galeri
    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }
}
