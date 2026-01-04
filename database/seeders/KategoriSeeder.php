<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
        'Handphone', 'Laptop', 'Dompet', 'Tas', 'Kunci',
        'Jam Tangan', 'Kamera', 'Tumblr', 'Kalung', 'Gelang',
        'Sepatu', 'Buku', 'Helm', 'Kacamata', 'Gantungan Kunci',
        'Jaket', 'Payung', 'Topi', 'Pouch', 'Lain-lain'
        ];

        foreach ($kategori as $k) {
            \App\Models\Kategori::create(['nama_kategori' => $k]);
        }
    }
}
