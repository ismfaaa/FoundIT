@extends('layout.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 text-center fw-bold">{{ $title }}</h5>
                </div>
                <div class="card-body p-4">
                    {{-- Info Ringkas Barang Asli --}}
                    <div class="d-flex align-items-center mb-4 p-3 border rounded bg-light">
                        <img src="{{ asset('storage/items/' . $item->foto_item) }}" width="100" class="rounded shadow-sm me-3">
                        <div>
                            <h6 class="mb-1 fw-bold text-primary">{{ $item->nama_item }}</h6>
                            <p class="mb-0 small text-muted"><i class="fas fa-map-marker-alt me-1"></i> Lokasi: {{ $item->kecamatan->nama_kecamatan }}</p>
                            <span class="badge bg-secondary mt-2">{{ $item->tipe_laporan }}</span>
                        </div>
                    </div>

                    <div class="alert alert-warning small mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i> 
                        <strong>Peringatan:</strong> Mohon isi detail di bawah ini dengan jujur untuk mempermudah proses verifikasi kepemilikan.
                    </div>

                    <form action="{{ route('claim.store', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Foto Bukti (Sekarang Wajib/Required) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Bukti Kepemilikan <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="foto_bukti" required>
                            <small class="text-muted">Wajib: Upload foto pendukung (nota, foto lama dengan barang, dsb).</small>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            {{-- Warna --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Warna Dominan</label>
                                <select class="form-select" name="warna" required>
                                    <option selected disabled>Pilih Warna...</option>
                                    <option value="Biru">Biru</option>
                                    <option value="Merah">Merah</option>
                                    <option value="Abu">Abu</option>
                                    <option value="Hitam">Hitam</option>
                                    <option value="Putih">Putih</option>
                                    <option value="Cokelat">Cokelat</option>
                                </select>
                            </div>

                            {{-- Material --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Material Bahan</label>
                                <select class="form-select" name="material" required>
                                    <option selected disabled>Pilih Bahan...</option>
                                    <option value="Kulit">Kulit</option>
                                    <option value="Plastik">Plastik</option>
                                    <option value="Kain">Kain</option>
                                    <option value="Logam">Logam</option>
                                    <option value="Kaca">Kaca</option>
                                </select>
                            </div>

                            {{-- Ukuran --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Ukuran Barang</label>
                                <select class="form-select" name="ukuran" required>
                                    <option selected disabled>Pilih Ukuran...</option>
                                    <option value="Besar">Besar (Tas, Helm)</option>
                                    <option value="Sedang">Sedang (Dompet, HP)</option>
                                    <option value="Kecil">Kecil (Kunci, Cincin)</option>
                                </select>
                            </div>

                            {{-- Kondisi --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kondisi Barang</label>
                                <select class="form-select" name="kondisi" required>
                                    <option selected disabled>Pilih Kondisi...</option>
                                    <option value="Utuh/Baru">Utuh/Baru</option>
                                    <option value="Lecet/Lama">Lecet/Lama</option>
                                    <option value="Rusak Sebagian">Rusak Sebagian</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Merk/Brand</label>
                            <input type="text" class="form-control" name="merk" placeholder="Sebutkan merk barang" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Ciri Khusus / Deskripsi Bukti</label>
                            <textarea class="form-control" name="deskripsi_bukti" rows="4" 
                                placeholder="Contoh: Ada stiker kucing di pojok kanan atas..." required></textarea>
                            <small class="text-muted">Minimal 20 karakter.</small>
                        </div>

                        {{-- Tombol dalam satu baris --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('items.index') }}" class="btn btn-light w-50 py-2 fw-bold">Batal</a>
                            <button type="submit" class="btn btn-primary w-50 py-2 fw-bold">{{ $buttonText }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection