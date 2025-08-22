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
        'description_files',
        'description_photos',
        'description_photos_text', // <-- tambahan
        'kompetensi_dasar',
        'kompetensi_dasar_files',
        'kompetensi_dasar_photos',
        'kompetensi_dasar_photos_text', // <-- tambahan
        'tujuan_pembelajaran',
        'tujuan_pembelajaran_files',
        'tujuan_pembelajaran_photos',
        'tujuan_pembelajaran_photos_text', // <-- tambahan
        'kurikulum_sinkronisasi',
        'kurikulum_sinkronisasi_files',
        'kurikulum_sinkronisasi_photos',
        'kurikulum_sinkronisasi_photos_text', // <-- tambahan
        'program_unggulan',
        'program_unggulan_files',
        'program_unggulan_photos',
        'program_unggulan_photos_text', // <-- tambahan
        'tim_pengajar',
        'tim_pengajar_files',
        'tim_pengajar_photos',
        'tim_pengajar_photos_text', // <-- tambahan
        'galeri_kegiatan',
        'galeri_kegiatan_files',
        'galeri_kegiatan_photos',
        'galeri_kegiatan_photos_text', // <-- tambahan
        'kundudi',
        'kundudi_files',
        'kundudi_photos',
        'kundudi_photos_text', // <-- tambahan
        'industri_pasangan',
        'industri_pasangan_files',
        'industri_pasangan_photos',
        'industri_pasangan_photos_text', // <-- tambahan
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
