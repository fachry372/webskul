<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LainnyaKonten extends Model
{
    use HasFactory;

    protected $table = 'lainnya_konten';

    protected $fillable = [
        'lainnya_id',
        'title',
        'text',
        'photos',
        'videos',
        'file',
    ];

    protected $casts = [
        'photos' => 'array',
        'videos' => 'array',
    ];

    public function lainnya()
    {
        return $this->belongsTo(Lainnya::class, 'lainnya_id');
    }

    public function blocks()
    {
        return $this->hasMany(LainnyaKontenBlock::class, 'lainnya_konten_id');
    }
}
