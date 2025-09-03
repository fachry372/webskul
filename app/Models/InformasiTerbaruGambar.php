<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiTerbaruGambar extends Model
{
    use HasFactory;
    protected $table = 'informasi_terbaru_gambar'; // <- Tambahkan ini
    protected $fillable = ['informasi_id', 'nama_file'];

    public function informasi() {
        return $this->belongsTo(InformasiTerbaru::class, 'informasi_id');
    }
}
