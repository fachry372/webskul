<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LainnyaKontenBlock extends Model
{
    use HasFactory;

    protected $table = 'lainnya_konten_blocks';

    protected $fillable = [
        'lainnya_konten_id',
        'title',
        'text',
        'photos',
        'videos',
        'files',
        'videos_link',
    ];

    protected $casts = [
        'photos' => 'array',
        'videos' => 'array',
        'files' => 'array',
        'videos_link' => 'array',
    ];

    public function konten()
    {
        return $this->belongsTo(LainnyaKonten::class, 'lainnya_konten_id');
    }
}
