<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelulusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
    ];

    public function blocks()
    {
        return $this->hasMany(KelulusanBlock::class);
    }
}
