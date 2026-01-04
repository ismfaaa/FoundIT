<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
class Kecamatan extends Model
{
    protected $guarded = ['id'];

    // Satu kecamatan punya banyak item
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // satu kecamatan punya banyak kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}