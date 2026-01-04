<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Verifikasi extends Model
{
    use HasFactory;

    // Kolom yang tidak boleh diisi secara massal
    protected $guarded = ['id'];

    // Relasi dengan model Item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
