<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Kategori extends Model
{
    protected $guarded = ['id']; 
    // biar bisa input data lewat seeder/admin

    // Satu kategori punya banyak item
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}