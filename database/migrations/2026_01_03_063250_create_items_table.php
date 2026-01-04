<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipe_laporan', ['Kehilangan', 'Temuan']); // Penentu Pemilik/Penemu
            $table->string('nama_item');
            $table->string('foto_item');

            // on cascade artinya jika data di tabel parent dihapus, maka data di tabel child yang berelasi juga akan terhapus secara otomatis
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');;
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade');;
            
            
            $table->string('lokasi_detail');
            $table->date('tanggal_kejadian');
            
            // 5 Detail Rahasia untuk Verifikasi
            $table->string('warna');
            $table->string('merk');
            $table->string('material');
            $table->string('ukuran');
            $table->string('kondisi');
            
            $table->enum('status_item', ['Aktif', 'Selesai'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
