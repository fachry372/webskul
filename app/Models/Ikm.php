<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikm extends Model
{
    use HasFactory;

    // table name opsional kalau defaultnya "ikms"
    protected $table = 'ikms';

    // agar bisa mass assignment
    protected $fillable = [
        'title',
        'slug',
    ];
}
