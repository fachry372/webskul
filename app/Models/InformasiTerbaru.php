<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InformasiTerbaru extends Model
{
    use HasFactory;
    protected $table = 'informasi_terbaru'; // <- Tambahkan ini
    protected $fillable = ['judul', 'slug', 'isi', 'kategori_id', 'status', 'tanggal_publish'];

       // Tambahkan ini
       protected $casts = [
        'tanggal_publish' => 'datetime',
    ];
    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->judul);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->judul);
        });
    }

    public function kategori() {
        return $this->belongsTo(KategoriInformasi::class, 'kategori_id');
    }

    public function gambar() {
        return $this->hasMany(InformasiTerbaruGambar::class, 'informasi_id');
    }
}
