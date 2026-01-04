@extends('layout.main')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-center fw-bold">Aktivitas Mu</h3>
    
    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="posting-tab" data-bs-toggle="tab" data-bs-target="#posting-tab-pane" type="button" role="tab">History Posting</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="claim-tab" data-bs-toggle="tab" data-bs-target="#claim-tab-pane" type="button" role="tab">History Klaim</button>
        </li>
    </ul>

    <div class="tab-content bg-white p-3 shadow-sm rounded-bottom" id="myTabContent">
        {{-- history posting --}}
        <div class="tab-pane fade show active" id="posting-tab-pane" role="tabpanel">
            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Item</th>
                            <th>Tipe</th>
                            <th>Tanggal Post</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myPostings as $index => $post)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('storage/items/' . $post->foto_item) }}" width="60" class="rounded shadow-sm">
                            </td>
                            <td class="fw-bold">{{ $post->nama_item }}</td>
                            <td>
                                <span class="badge {{ $post->tipe_laporan == 'Temuan' ? 'text-bg-success' : 'text-bg-danger' }}">
                                    {{ $post->tipe_laporan }}
                                </span>
                            </td>
                            <td>{{ $post->created_at->format('d M Y') }}</td>
                            <td>
                                <span class="badge text-bg-primary">{{ $post->status_item }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <button class="btn btn-outline-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Kamu belum pernah memposting barang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- history klaim dinamis --}}
        <div class="tab-pane fade" id="claim-tab-pane" role="tabpanel">
            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Tanggal Klaim</th>
                            <th>Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myClaims as $index => $claim)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/items/' . $claim->item->foto_item) }}" width="50" class="rounded me-2">
                                    <span class="fw-bold">{{ $claim->item->nama_item }}</span>
                                </div>
                            </td>
                            <td>{{ $claim->created_at->format('d M Y') }}</td>
                            <td>
                                @if($claim->status_claim == 'Diterima')
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Diterima</span>
                                @elseif($claim->status_claim == 'Ditolak')
                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Ditolak</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Sedang Diproses</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Anda belum pernah mengajukan klaim barang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection