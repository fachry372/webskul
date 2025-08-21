<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($jurusan) {
        $jurusan->slug = Str::slug($jurusan->name, '-');
    });

    static::updating(function ($jurusan) {
        $jurusan->slug = Str::slug($jurusan->name, '-');
    });
}
}
