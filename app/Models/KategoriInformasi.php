<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriInformasi extends Model
{
    use HasFactory;


    protected $table = 'kategori_informasi'; // <- Tambahkan ini
    protected $fillable = ['nama', 'slug'];

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->nama);
        });
    }

    public function informasis() {
        return $this->hasMany(InformasiTerbaru::class, 'kategori_id');
    }
}
