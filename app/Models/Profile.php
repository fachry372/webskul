<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public function menus()
    {
        return $this->hasMany(Menu::class); // atau ProfileItem::class jika itu nama model menu
    }
}