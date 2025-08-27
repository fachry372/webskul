<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkmKonten extends Model
{
    protected $table = 'ikm_konten';

    protected $fillable = [
        'ikm_id',
        'title',
        'text',
        'photos',
        'videos',
        'files', // konsisten dengan nama kolom
    ];

    protected $casts = [
        'photos' => 'array',
        'videos' => 'array',
        'files'  => 'array',
    ];

    // Relasi ke IKM
    public function ikm()
    {
        return $this->belongsTo(Ikm::class);
    }

    // Relasi ke blok konten
    public function blocks()
    {
        return $this->hasMany(IkmKontenBlock::class, 'ikm_konten_id');
    }
}
