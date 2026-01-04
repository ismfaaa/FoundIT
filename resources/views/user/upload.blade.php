@extends('layout.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{-- Dinamis mengikuti link yang diklik (?type=Temuan atau ?type=Kehilangan) --}}
                    <h5 class="mb-0">Form Posting {{ $type }} Barang</h5>
                </div>
                <div class="card-body p-4">
                    {{-- Menampilkan error validasi mudah tahu yang mana diperbaiki --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- Diarahkan ke route upload.store dan di handle controller item --}}
                    <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- input tersembunyi untuk Menentukan apakah ini laporan 'Kehilangan' atau 'Temuan' di database --}}
                        <input type="hidden" name="tipe_laporan" value="{{ $type }}">

                        {{-- Nama Barang --}}
                        <div class="mb-3">
                            <label for="nama_item" class="form-label fw-bold">Nama Barang</label>
                            {{-- Name disesuaikan dengan migration 'nama_item' --}}
                            <input type="text" class="form-control" name="nama_item" id="nama_item" placeholder="Contoh: Dompet Kulit Cokelat" required>
                        </div>

                        {{-- Foto Barang --}}
                        <div class="mb-3">
                            <label for="foto_item" class="form-label fw-bold">Foto Barang</label>
                            <input class="form-control" type="file" name="foto_item" id="foto_item" required>
                            <small class="text-muted">Gunakan foto yang jelas untuk mempermudah identifikasi.</small>
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label fw-bold">Kategori Barang</label>
                            <select class="form-select" name="kategori_id" id="kategori_id" required>
                                <option selected disabled>Pilih Kategori...</option>
                                {{--  Looping data untuk generate semua data kategori dari database --}}
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="my-4">
                        <h6 class="text-primary fw-bold mb-3">Detail Verifikasi Sistem (Rahasia)</h6>

                        <div class="row">
                            {{-- 1. Warna --}}
                            <div class="col-md-6 mb-3">
                                <label for="warna" class="form-label">Warna Dominan</label>
                                <select class="form-select" name="warna" id="warna" required>
                                    <option selected disabled>Pilih Warna...</option>
                                    <option value="Biru">Biru</option>
                                    <option value="Merah">Merah</option>
                                    <option value="Abu">Abu</option>
                                    <option value="Hitam">Hitam</option>
                                    <option value="Putih">Putih</option>
                                    <option value="Cokelat">Cokelat</option>
                                </select>
                            </div>

                            {{-- 2. Kondisi --}}
                            <div class="col-md-6 mb-3">
                                <label for="kondisi" class="form-label">Kondisi Fisik</label>
                                <select class="form-select" name="kondisi" id="kondisi" required>
                                    <option selected disabled>Pilih Kondisi...</option>
                                    <option value="Utuh/Baru">Utuh/Baru</option>
                                    <option value="Lecet/Lama">Lecet/Lama</option>
                                    <option value="Rusak Sebagian">Rusak Sebagian</option>
                                </select>
                            </div>

                            {{-- 3. Merk --}}
                            <div class="col-md-6 mb-3">
                                <label for="merk" class="form-label">Merk/Brand</label>
                                <input type="text" class="form-control" name="merk" id="merk" placeholder="Contoh: Nike / Samsung" required>
                            </div>

                            {{-- 4. Ukuran --}}
                            <div class="col-md-6 mb-3">
                                <label for="ukuran" class="form-label">Ukuran</label>
                                <select class="form-select" name="ukuran" id="ukuran" required>
                                    <option selected disabled>Pilih Ukuran...</option>
                                    <option value="Besar">Besar (Tas, Helm)</option>
                                    <option value="Sedang">Sedang (Dompet, HP)</option>
                                    <option value="Kecil">Kecil (Kunci, Cincin)</option>
                                </select>
                            </div>

                            {{-- 5. Material --}}
                            <div class="col-md-12 mb-3">
                                <label for="material" class="form-label">Material (Bahan)</label>
                                <select class="form-select" name="material" id="material" required>
                                    <option selected disabled>Pilih Bahan...</option>
                                    <option value="Kulit">Kulit</option>
                                    <option value="Plastik">Plastik</option>
                                    <option value="Kain">Kain</option>
                                    <option value="Logam">Logam</option>
                                    <option value="Kaca">Kaca</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Lokasi Detail --}}
                        <div class="mb-4">
                            <label for="kecamatan_id" class="form-label fw-bold">Wilayah (Kecamatan)</label>
                            <select class="form-select" name="kecamatan_id" id="kecamatan_id" required>
                                <option selected disabled>Pilih Lokasi...</option>
                                {{-- looping data untuk kecamatan --}}
                                @foreach($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi_detail" class="form-label fw-bold">Lokasi Detail (TKP)</label>
                            <input type="text" class="form-control" name="lokasi_detail" placeholder="Misal: Depan gerbang masjid atau Cafe A" required>
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_kejadian" class="form-label fw-bold">Tanggal Kejadian</label>
                            <input type="date" class="form-control" name="tanggal_kejadian" required>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-grid gap-2">
                            {{-- Nama tombol berubah sesuai tipe laporan --}}
                            <button type="submit" class="btn btn-primary btn-lg">Posting Barang {{ $type }}</button>
                            <a href="{{ route('home') }}" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection