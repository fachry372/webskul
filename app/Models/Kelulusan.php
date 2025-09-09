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
        'status', // tambahkan status
    ];

    /**
     * Relasi ke blok kelulusan.
     */
    public function blocks()
    {
        return $this->hasMany(KelulusanBlock::class);
    }

    /**
     * Scope untuk data yang publish saja.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    /**
     * Scope untuk data draft saja.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
