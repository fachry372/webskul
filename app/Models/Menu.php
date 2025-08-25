<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'profile_id',
        'title',
        'content',           // konten utama
        'content_section_photos',    // array foto (json)
        'content_section_photos_text', // teks di bawah foto
        'content_section_files',     // array file (json)
        'image',                     // gambar utama
    ];

    // Jika ingin casting JSON otomatis ke array
    protected $casts = [
        'content_section_photos' => 'array',
        'content_section_files' => 'array',
    ];

    /**
     * Relasi ke Profile
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
