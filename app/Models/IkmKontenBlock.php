<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkmKontenBlock extends Model
{
    protected $table = 'ikm_konten_blocks';

    protected $fillable = [
        'ikm_konten_id',
        'title',
        'text',
        'photos',
        'videos',
        'videos_link',
        'files',
    ];

    protected $casts = [
        'photos'      => 'array',
        'videos'      => 'array',
        'videos_link' => 'array',
        'files'       => 'array',
    ];

    // Relasi ke konten induk
    public function ikmKonten()
    {
        return $this->belongsTo(IkmKonten::class, 'ikm_konten_id');
    }
}
