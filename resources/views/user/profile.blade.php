@extends('layout.main')

@section('content')
    <div class="row p-4 m-3">
        {{-- foto profil --}}
        
        <div class="col-6 col-md-4 justify-content-center d-flex flex-column align-items-center">
            <img src="{{ Auth::user()->foto_user ? asset('storage/foto/' . Auth::user()->foto_user) : asset('assets/img/undraw_profile.svg') }}" 
                class="rounded-circle mb-3" 
                alt="Foto Profil" 
                width="200" 
                height="200">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalFoto">
                Ganti Foto <i class="fas fa-edit"></i>
            </button>

        </div>

        {{-- informasi profil --}}
        <div class="col-md-8 justify-content-center">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Username</div>
                        {{ Auth::user()->username }}
                        </div>
                        <a href="" data-toggle="modal" data-target="#modalUsername"><i class="fas fa-edit"></i></a>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Email</div>
                    {{  Auth::user()->email }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Kota/Kabupaten Domisili</div>

                        {{-- domisili yang bisa null, kodenya gini --}}
                        {{ Auth::user()->domisili ?? 'Belum diisi' }}
                        </div>
                        <a href="" data-toggle="modal" data-target="#modalDomisili"><i class="fas fa-edit"></i></a>
                    </div>
                </li>
                
            </ul>
        </div>
    </div>

    {{-- modal profil all --}}
{{-- edit foto profil --}}
<form action="{{ route('profile.updateFoto') }}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- menggunakan metode put karena cuma edit aja --}}
    @method('PUT')
    <div class="modal fade text-l" id="modalFoto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="staticBackdropLabel">Ganti Foto</h3>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ Auth::user()->foto_user ? asset('storage/foto/' . Auth::user()->foto_user) : asset('assets/img/undraw_profile.svg') }}" 
                            class="rounded-circle mb-3" 
                            alt="Foto Profil" 
                            width="200" 
                            height="200">
                        <input type="file" name="foto_user" class="form-control form-control-sm" id="formFileSm">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- untuk edit username --}}
<form action="{{ route('profile.update') }}" method="POST"> 
    @csrf
    @method('PUT') 
    <div class="modal fade text-l" id="modalUsername" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5">Edit Username</h3>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <input type="text" name="username" class="form-control form-control-sm" 
                            value="{{ Auth::user()->username }}" placeholder="Masukkan username baru" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>   

{{-- untuk edit kota/domisili --}}
<form action="{{ route('profile.update') }}" method="POST"> 
    @csrf
    @method('PUT') 
    <div class="modal fade text-l" id="modalDomisili" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5">Edit Kota/Kabupaten</h3>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <input type="text" name="domisili" class="form-control form-control-sm" 
                            value="{{ Auth::user()->domisili }}" placeholder="Masukkan kota/kabupaten baru" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>     


@endsection