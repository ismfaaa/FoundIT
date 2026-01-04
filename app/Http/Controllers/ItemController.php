<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // ================================ DAFTAR BARANG ==================================
    public function index(Request $request)
    {
        // 1. Ambil kata kunci dari input search di navbar/form
        $search = $request->query('search');

        $sort = $request->query('sort'); // Ambil parameter sort

        // FITUR BARU: Ambil parameter kecamatan untuk filter
        $kecamatan = $request->query('kecamatan');

        // 2. Siapkan query awal
        $query = Item::with(['kategori', 'kecamatan']);

        // Logika SORTING untuk mengurutkan berdasarkan tanggal
        // PERBAIKAN: Sorting diletakkan sebelum pagination agar akurat
        if ($sort == 'terlama') {
            $query->oldest(); // Urutkan dari yang paling lama
        } else {
            $query->latest(); // Default: Terbaru
        }

        // FITUR BARU: Logika filter per Kecamatan
        if ($kecamatan && $kecamatan != 'all') {
            $query->where('kecamatan_id', $kecamatan);
        }

        // 3. Logika WHERE: Jika ada kata kunci, filter datanya
        // PERBAIKAN: Gunakan grouping function($q) agar OR tidak merusak filter lain
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_item', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi_detail', 'LIKE', "%{$search}%")
                  ->orWhere('merk', 'LIKE', "%{$search}%")    
                  ->orWhere('warna', 'LIKE', "%{$search}%");
            });
        }

        // 4. Eksekusi dengan pagination
        $items = $query->paginate(4)->withQueryString(); 
        // withQueryString() ==> supaya pas pindah halaman pagination, hasil search-nya gak ilang
            
        // FITUR BARU: Ambil data kecamatan untuk dropdown filter di view
        $kecamatans = Kecamatan::all();
    
        return view('user.item-list', compact('items', 'kecamatans'));
    }

    // ================================ FORM UPLOAD ==================================
        public function create(Request $request)
    {
        // Mengambil parameter 'type' dari URL (?type=Temuan)
        $type = $request->query('type', 'Temuan');

        // Mengambil data-data untuk rincian barang juga untuk isi dropdown di View
        $kategoris = Kategori::all();
        $kecamatans = Kecamatan::all();

        return view('user.upload', compact('type', 'kategoris', 'kecamatans'));
    }

    // ================================ SIMPAN DATA UPLOAD ==================================
    public function store(Request $request)
    {
        // 1. Validasi Data sesuai struktur migrasi
        $request->validate([
            'tipe_laporan'     => 'required|in:Kehilangan,Temuan',
            'nama_item'        => 'required|string|max:255',
            'foto_item'        => 'required|image|mimes:jpeg,png,jpg|max:102400', // max 100MB
            'kategori_id'      => 'required|exists:kategoris,id',
            'kecamatan_id'     => 'required|exists:kecamatans,id',
            'lokasi_detail'    => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'warna'            => 'required|string',
            'merk'             => 'required|string',
            'material'         => 'required|string',
            'ukuran'           => 'required|string',
            'kondisi'          => 'required|string',
        ]);

        // Inisialisasi variabel di luar IF agar tidak undefined
        $fileName = null;

        // 2. Handle Upload Foto ke storage/app/public/items
        if ($request->hasFile('foto_item')) {
            $file = $request->file('foto_item');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('items', $fileName, 'public');
        }

        // 3. Simpan ke Database
        Item::create([
            'user_id'          => Auth::id(), // Pengidentifikasi siapa yang posting
            'tipe_laporan'     => $request->tipe_laporan,
            'nama_item'        => $request->nama_item,
            'foto_item'        => $fileName,
            'kategori_id'      => $request->kategori_id,
            'kecamatan_id'     => $request->kecamatan_id,
            'lokasi_detail'    => $request->lokasi_detail,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'warna'            => $request->warna,
            'merk'             => $request->merk,
            'material'         => $request->material,
            'ukuran'           => $request->ukuran,
            'kondisi'          => $request->kondisi,
            'status_item'      => 'Aktif', // Sesuai default di migrasi
        ]);

        // Redirect diarahkan ke items.index atau home sesuai alur lo
        return redirect()->route('items.index')->with('success', 'Laporan barang ' . $request->tipe_laporan . ' berhasil diposting!');
    }

    // ================================= KLAIM BARANG ==================================
    public function showClaimForm($item_id)
    {
        $item = Item::findOrFail($item_id);
        
        // Tentukan teks judul berdasarkan tipe laporan barangnya
        $title = ($item->tipe_laporan == 'Temuan') ? 'Klaim Barang Milikmu' : 'Bantu Temukan Barang Ini';
        $buttonText = ($item->tipe_laporan == 'Temuan') ? 'Ajukan Klaim' : 'Kirim Informasi';

        return view('user.claim-item', compact('item', 'title', 'buttonText'));
    }

    public function processClaim(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        
        // 1. Gabungan validasi 
        $request->validate([
            'warna' => 'required',
            'material' => 'required',
            'ukuran' => 'required',
            'kondisi' => 'required',
            'merk' => 'required',
            'deskripsi_bukti' => 'required|min:20',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // 2. Logika verifikasi sistem (Minimal 4 Sesuai)
        $matchCount = 0;
        if ($request->warna == $item->warna) $matchCount++;
        if ($request->material == $item->material) $matchCount++;
        if ($request->ukuran == $item->ukuran) $matchCount++;
        if ($request->kondisi == $item->kondisi) $matchCount++;

        $status = ($matchCount >= 4) ? 'Proses' : 'Ditolak';

        // 3. Handle Upload Foto Bukti
        $fileName = null;
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $fileName = time() . '_bukti_' . Auth::id() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('claims', $fileName, 'public');
        }

        // 4. Simpan ke Tabel Claims 
        \App\Models\Claim::create([
            'item_id' => $item->id,
            'user_id' => Auth::id(),
            'warna' => $request->warna,
            'material' => $request->material,
            'ukuran' => $request->ukuran,
            'kondisi' => $request->kondisi,
            'merk' => $request->merk,
            'deskripsi_bukti' => $request->deskripsi_bukti,
            'foto_bukti' => $fileName,
            'status_claim' => $status,
        ]);

        if ($status == 'Ditolak') {
            return redirect()->route('items.index')->with('error', 'Klaim gagal. Detail tidak cocok dengan data kami.');
        }

        return redirect()->route('activity')->with('success', 'Klaim berhasil diajukan!');
    }

    // ================================= TERIMA KLAIM BARANG ==================================
    public function acceptClaim($id)
    {
        $claim = \App\Models\Claim::findOrFail($id);
        
        // 1. Update status di tabel claims
        $claim->update(['status_claim' => 'Diterima']);

        // 2. Buat data di tabel verifikasis sesuai struktur SQL lo
        \App\Models\Verifikasi::create([
            'item_id'           => $claim->item_id,
            'user_id'           => $claim->user_id, // Si pengklaim
            'foto_bukti'        => $claim->foto_bukti ?? 'default.jpg',
            'deskripsi_klaim'   => $claim->deskripsi_bukti,
            'status_verifikasi' => 'Pending', // Menunggu proses chat/pertemuan
        ]);

        return redirect()->route('verification')->with('success', 'Klaim diterima! Silahkan lanjut chat dengan pemilik.');
    }
}