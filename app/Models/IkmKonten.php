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
        'file',
    ];

    protected $casts = [
        'photos' => 'array',
        'videos' => 'array',
        'file'   => 'array', // tambahkan cast array
    ];

    public function getBlocksAttribute()
{
    return [
        [
            'title' => $this->title,
            'text'  => $this->text,
            'photos'=> $this->photos ?? [],
            'videos'=> $this->videos ?? [],
            'files' => $this->file ?? [], // sesuai Blade
        ]
    ];
}



    public function ikm()
    {
        return $this->belongsTo(Ikm::class, 'ikm_id');
    }

    public function blocks()
{
    return $this->hasMany(IkmKontenBlock::class);
}

}
