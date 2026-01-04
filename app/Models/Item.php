<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kategori;
use App\Models\Chat;


class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Relasi antara Item dengan User, Kecamatan, Kategori, dan Chat

    // satu item dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // satu item berada di satu kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    // satu item punya satu kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // satu item bisa punya banyak chat
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}