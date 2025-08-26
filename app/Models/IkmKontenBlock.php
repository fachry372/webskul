<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkmKontenBlock extends Model
{
    protected $fillable = ['ikm_konten_id', 'title', 'text', 'photos', 'videos', 'files'];

    protected $casts = [
        'photos' => 'array',
        'videos' => 'array',
        'files' => 'array',
    ];

    public function ikmKonten()
    {
        return $this->belongsTo(IkmKonten::class);
    }
}
