<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lainnya extends Model
{
    use HasFactory;

    protected $table = 'lainnya';

    protected $fillable = [
        'title',
        'slug',
    ];

    public function konten()
    {
        return $this->hasMany(LainnyaKonten::class, 'lainnya_id');
    }
}
