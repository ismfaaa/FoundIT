<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    // ================================ DAFTAR KLAIM MASUK & VERIFIKASI ==================================
    public function index()
    {
        // 1. Klaim yang MASUK (Orang lain mengklaim barang milik User yang login)
        $incomingClaims = Claim::whereHas('item', function($q) {
            $q->where('user_id', Auth::id());
        })
        ->where('status_claim', 'Proses') // Hanya tampilkan yang belum diputuskan
        ->with(['item', 'user'])
        ->latest()
        ->get();

        // 2. Notifikasi Verifikasi Lanjut (Klaim yang sudah di-approve dan masuk tahap chat)
        $activeVerifications = Verifikasi::where(function($q) {
            $q->where('user_id', Auth::id()) // User sebagai pengklaim
              ->orWhereHas('item', function($query) {
                  $query->where('user_id', Auth::id()); // User sebagai penemu
              });
        })
        ->with(['item', 'user'])
        ->latest()
        ->get();

        return view('user.verification', compact('incomingClaims', 'activeVerifications'));
    }

    // ================================= SETUJUI KLAIM BARANG ==================================
    public function approve($id)
    {
        $claim = Claim::findOrFail($id);
        
        // 1. Update status di tabel claims
        $claim->update(['status_claim' => 'Diterima']);

        // 2. Buat data Verifikasi sesuai struktur SQL (db_projectbesar.sql)
        $verifikasi = Verifikasi::create([
            'item_id'           => $claim->item_id,
            'user_id'           => $claim->user_id, // Si pengklaim
            'foto_bukti'        => $claim->foto_bukti ?? 'default.jpg', // Mengambil foto dari klaim
            'deskripsi_klaim'   => $claim->deskripsi_bukti,
            'status_verifikasi' => 'Pending', // Sesuai enum di SQL: Pending, Approved, Rejected
        ]);

        return redirect()->route('verification')
                        ->with('success', 'Klaim diterima! Silahkan hubungi pengklaim melalui fitur chat.');
    }

    // ================================= TOLAK KLAIM BARANG ==================================
    public function reject($id)
    {
        $claim = Claim::findOrFail($id);
        
        $claim->update(['status_claim' => 'Ditolak']);

        return redirect()->back()->with('error', 'Klaim telah ditolak.');
    }
}