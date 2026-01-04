<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatan = [
        'Purwakarta', 'Babakancikao', 'Pasawahan', 'Campaka', 'Cibatu', 
        'Bungursari', 'Pondoksalam', 'Wanayasa', 'Kiarapedes', 'Bojong', 
        'Darangdan', 'Plered', 'Tegalwaru', 'Maniis', 'Jatiluhur', 
        'Sukasari', 'Sukatani'
    ];

    foreach ($kecamatan as $kec) {
        \App\Models\Kecamatan::create(['nama_kecamatan' => $kec]);
    }
    }
}
