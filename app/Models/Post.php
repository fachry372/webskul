<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'jurusan_id',
        'user_id',
        'title',
        'description',
        'description_photos',
        'kompetensi_dasar',
        'kompetensi_dasar_photos',
        'tujuan_pembelajaran',
        'tujuan_pembelajaran_photos',
        'kurikulum_sinkronisasi',
        'kurikulum_sinkronisasi_photos',
        'program_unggulan',
        'program_unggulan_photos',
        'tim_pengajar',
        'tim_pengajar_photos',
        'galeri_kegiatan',
        'galeri_kegiatan_photos',
        'kundudi',
        'kundudi_photos',
        'industri_pasangan',
        'industri_pasangan_photos',
        'image',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
