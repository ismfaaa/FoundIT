<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relation;

class VerifikasiController extends Controller
{
    public function index()
    {
        // 1. Ambil klaim yang masuk ke barang milik user yang sedang login
        $incomingClaims = Claim::whereHas('item', function($q) {
            $q->where('user_id', Auth::id());
        })
        ->where('status_claim', 'Proses')
        ->with(['item', 'user'])
        ->latest()
        ->get();

        // 2. Ambil verifikasi/chat yang sedang berjalan
        $activeVerifications = Verifikasi::where(function($q) {
            $q->where('user_id', Auth::id()) // User sebagai pengklaim
              ->orWhereHas('item', function($query) {
                  $query->where('user_id', Auth::id()); // User sebagai penemu
              });
        })
        ->with(['item', 'user'])
        ->latest()
        ->get();

        // Kirim data ke view
        return view('user.verification', compact('incomingClaims', 'activeVerifications'));
    }
}