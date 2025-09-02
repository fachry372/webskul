<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelulusanBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelulusan_id',
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

    public function kelulusan()
    {
        return $this->belongsTo(Kelulusan::class);
    }
}
