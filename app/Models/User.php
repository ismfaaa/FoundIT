<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Item;

class User extends Authenticatable
{
        use HasFactory, Notifiable;

        // kolom-kolom yang boleh diisi secara massal
        protected $fillable = [
            'username',
            'email',
            'password',
            'role',
            'domisili',
            'help_point',
            'foto_user',
        ];

        // kolom-kolom yang harus disembunyikan saat model diubah menjadi array atau JSON
        protected $hidden = [
            'password',
        ];

        // Relasi: Satu user bisa posting banyak item (barang hilang/temuan)
        public function items()
        {
            return $this->hasMany(Item::class);
        }
}
