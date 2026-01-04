@extends('layout.main')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold"><i class="fas fa-check-double text-primary me-2"></i>Pusat Verifikasi</h3>

    <div class="row">
        {{-- BAGIAN KIRI: Daftar Klaim Masuk (Penemu Cek Pengklaim) --}}
        <div class="col-md-7">
            <h5 class="mb-3 fw-bold text-gray-800">Permintaan Klaim Masuk</h5>
            <div class="list-group shadow-sm">
                @forelse($incomingClaims as $claim)
                <div class="list-group-item list-group-item-action p-3 mb-2 rounded border shadow-sm">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-primary me-3 text-white d-flex justify-content-center align-items-center" style="width: 45px; height: 45px; border-radius: 50%;">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $claim->user->username }} Mengklaim Barangmu</h6>
                                <small class="text-muted">Item: <strong>{{ $claim->item->nama_item }}</strong></small>
                            </div>
                        </div>
                        <small class="text-gray-500">{{ $claim->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="mt-3 p-2 bg-light rounded border-start border-primary border-4">
                        <p class="mb-1 small text-dark"><strong>Merk:</strong> {{ $claim->merk }}</p>
                        <p class="mb-0 small text-muted text-truncate" style="max-width: 400px;">"{{ $claim->deskripsi_bukti }}"</p>
                    </div>
                    <div class="mt-3 d-flex gap-2">
                        <form action="{{ route('claim.approve', $claim->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">Terima & Lanjut Chat</button>
                        </form>
                        <form action="{{ route('claim.reject', $claim->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Tolak</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 border rounded bg-white">
                    <i class="fas fa-bell-slash fa-3x text-light mb-3"></i>
                    <p class="text-muted">Belum ada permintaan klaim baru untuk barangmu.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- BAGIAN KANAN: Status Verifikasi Lanjut (Proses Chat) --}}
        <div class="col-md-5">
            <h5 class="mb-3 fw-bold text-gray-800">Percakapan Aktif</h5>
            <div class="list-group shadow-sm">
                @forelse($activeVerifications as $veri)
                <a href="{{ route('chat.show', $veri->id) }}" class="list-group-item list-group-item-action mb-2 rounded border">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h6 class="mb-1 fw-bold text-primary"><i class="fas fa-comments me-2"></i>Diskusi Barang</h6>
                        <span class="badge rounded-pill bg-info text-white">{{ $veri->status_verifikasi }}</span>
                    </div>
                    <p class="mb-1 small">Lakukan koordinasi pengembalian barang <strong>{{ $veri->item->nama_item }}</strong>.</p>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <small class="text-success fw-bold">Klik untuk masuk Chat &rarr;</small>
                        <small class="text-muted small">{{ $veri->updated_at->format('d/m H:i') }}</small>
                    </div>
                </a>
                @empty
                <div class="text-center py-4 border rounded bg-light">
                    <small class="text-muted">Belum ada diskusi aktif.</small>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection