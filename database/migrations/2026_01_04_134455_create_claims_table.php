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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            // Relasi ke barang yang diklaim dan siapa yang klaim
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data untuk Verifikasi Sistem (pencocokan otomatis)
            $table->string('warna');
            $table->string('material');
            $table->string('ukuran');
            $table->string('kondisi');
            $table->string('merk'); // Merk nanti dicocokkan manual oleh penemu

            // Detail tambahan untuk Verifikasi User (Penemu)
            $table->string('foto_bukti')->nullable();
            $table->text('deskripsi_bukti'); 
            
            // Status klaim
            $table->enum('status_claim', ['Proses', 'Diterima', 'Ditolak'])->default('Proses');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
