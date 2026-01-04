@extends('layout.main')

@section('content')
    <div class="mt-3 mb-3 bg-white p-4 rounded-3">
        
        {{-- search dan filter --}}
        <nav class="navbar bg-body-tertiary mb-5">
            <div class="container-fluid d-flex align-items-center">
                <span class="fw-nold me-2 text-primary">Semua Item FoundIT Tersedia disini</span>
                <div class="mx-0">
                    <form class="d-none d-sm-inline-block form-inline border border-primary rounded ms-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search "
                    method="GET" action="{{ route('items.index') }}">
                        <div class="d-flex input-group">
                            <input
                            type="text"
                            name="search"
                            class="form-control bg-light border-0 small"
                            placeholder="Search for..."
                            aria-label="Search"
                            aria-describedby="basic-addon2"
                            value="{{ request('search') }}"
                            />
                            <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                            </div>
                        </div>
                    </form>
                    
                    <a class="btn btn-primary ms-3" 
                        data-bs-toggle="collapse" 
                        href="#collapseExample" 
                        role="button" aria-expanded="false" 
                        aria-controls="collapseExample">
                        <i class="bi bi-funnel text-white ">Filter</i>
                    </a>
                    <div class="collapse position-absolute z-3 end-0" id="collapseExample">
                        <div class="card card-body ms-auto mt-2 d-flex flex-column gap-2">

                            {{-- Filter berdasarkan kecamatan --}}
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Kecamatan
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Babakancikao</a></li>
                                    <li><a class="dropdown-item" href="#">Bojong</a></li>
                                    <li><a class="dropdown-item" href="#">Bungursari</a></li>
                                    <li><a class="dropdown-item" href="#">Campaka</a></li>
                                    <li><a class="dropdown-item" href="#">Cibatu</a></li>

                                    <li><a class="dropdown-item" href="#">Darangdan</a></li>
                                    <li><a class="dropdown-item" href="#">Jatiluhur</a></li>
                                    <li><a class="dropdown-item" href="#">Kiarapedes</a></li>
                                    <li><a class="dropdown-item" href="#">Maniis</a></li>
                                    <li><a class="dropdown-item" href="#">Pasawahan</a></li>

                                    <li><a class="dropdown-item" href="#">Plered</a></li>
                                    <li><a class="dropdown-item" href="#">Pondoksalam</a></li>
                                    <li><a class="dropdown-item" href="#">Purwakarta</a></li>
                                    <li><a class="dropdown-item" href="#">Sukatani</a></li>
                                    <li><a class="dropdown-item" href="#">Sukalingga</a></li>

                                    <li><a class="dropdown-item" href="#">Tegalwaru</a></li>
                                    <li><a class="dropdown-item" href="#">Wanayasa</a></li>
                                </ul>
                            </div>

                            {{-- Filter berdasarkan Tanggal --}}
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tanggal
                                </a>
                                
                                <ul class="dropdown-menu">
                                    {{-- Link untuk sortir tanggal terbaru --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'terbaru']) }}">Terbaru</a>
                                    </li>

                                    {{-- Link untuk sortir tanggal terlama --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'terlama']) }}">Terlama</a>
                                    </li>
                                </ul>
                            </div>

                            {{-- Filter berdasarkan Jenisnya --}}
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Item
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Handphone</a></li>
                                    <li><a class="dropdown-item" href="#">Laptop</a></li>
                                    <li><a class="dropdown-item" href="#">Dompet</a></li>
                                    <li><a class="dropdown-item" href="#">Tas</a></li>
                                    <li><a class="dropdown-item" href="#">Kunci</a></li>

                                    <li><a class="dropdown-item" href="#">Jam Tangan</a></li>
                                    <li><a class="dropdown-item" href="#">Kamera</a></li>
                                    <li><a class="dropdown-item" href="#">Tumblr</a></li>
                                    <li><a class="dropdown-item" href="#">Kalung</a></li>
                                    <li><a class="dropdown-item" href="#">Gelang</a></li>

                                    <li><a class="dropdown-item" href="#">Sepatu</a></li>
                                    <li><a class="dropdown-item" href="#">Buku</a></li>
                                    <li><a class="dropdown-item" href="#">Helm</a></li>
                                    <li><a class="dropdown-item" href="#">Kacamata</a></li>
                                    <li><a class="dropdown-item" href="#">Gantungan Kunci</a></li>

                                    <li><a class="dropdown-item" href="#">Jaket</a></li>
                                    <li><a class="dropdown-item" href="#">Payung</a></li>
                                    <li><a class="dropdown-item" href="#">Topi</a></li>
                                    <li><a class="dropdown-item" href="#">Pouch</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
        </nav>
        {{-- end search dan filter --}}

    
        {{-- isi item alias daftar itemnya --}}
        <div class="row">
    @foreach($items as $item)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-0">
            {{-- Lencana Tipe Laporan di pojok foto --}}
            <div class="position-absolute px-2 py-1 small rounded-end text-white {{ $item->tipe_laporan == 'Temuan' ? 'bg-success' : 'bg-danger' }}" style="z-index: 1; top: 10px;">
                {{ $item->tipe_laporan }}
            </div>

            {{-- Foto Barang: Mengambil dari storage/items --}}
            <img src="{{ asset('storage/items/' . $item->foto_item) }}" 
                 class="card-img-top" 
                 style="height: 180px; object-fit: cover;" 
                 alt="{{ $item->nama_item }}">

            <div class="card-body d-flex flex-column">
                <h6 class="card-title fw-bold mb-1 text-truncate">{{ $item->nama_item }}</h6>
                
                {{-- Info Kategori & Lokasi --}}
                <div class="small text-muted mb-2">
                    <i class="fas fa-tag me-1"></i> {{ $item->kategori->nama_kategori }} <br>
                    <i class="fas fa-map-marker-alt me-1"></i> {{ $item->kecamatan->nama_kecamatan }}
                </div>

                <p class="card-text small text-secondary flex-grow-1">
                    {{ Str::limit($item->lokasi_detail, 50) }}
                </p>

                <hr class="my-2">

                {{-- Logika Tombol Dinamis --}}
                @if($item->tipe_laporan == 'Temuan')
                    <a href="{{ route('claim.form', $item->id) }}" class="btn btn-primary btn-sm w-100">
                        Barangmu?
                    </a>
                @else
                    <a href="#" class="btn btn-outline-success btn-sm w-100">
                        Bantu
                    </a>
                @endif
            </div>
            
            <div class="card-footer bg-white border-0 py-2">
                <small class="text-muted" style="font-size: 0.75rem;">
                    Diposting {{ $item->created_at->diffForHumans() }}
                </small>
            </div>
        </div>
    </div>
    @endforeach
    
</div>

    {{-- Pagination Otomatis Yang disediakan Laravel --}}
    <div class="d-flex justify-content-center mt-4">
    {{ $items->links() }}
    </div>

        {{-- end isi item --}}

        {{-- contoh kartu item --}}
        {{-- <div class="card" style="width: 18rem;">
            <img src="{{ asset('assets/img/undraw_profile.svg') }}" class="card-img-top" style="height:100px;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text small">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                <a href="#" class="btn btn-primary small">Go somewhere</a>
            </div>
        </div> --}}

        {{-- Pagination Manual--}}
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center mt-4">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav> --}}

    

@endsection