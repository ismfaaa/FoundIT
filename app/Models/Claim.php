<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'user_id', 'warna', 'material', 
        'ukuran', 'kondisi', 'merk', 'foto_bukti', 
        'deskripsi_bukti', 'status_claim'
    ];

    // Relasi ke User (Siapa yang mengajukan klaim)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Item (Barang apa yang diklaim)
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}