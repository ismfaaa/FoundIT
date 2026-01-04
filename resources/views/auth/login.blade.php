@extends('layout.main')

@section('content')
    <div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <form class="user" action="/login" method="post">
            
            @csrf
                <div class="form-group" >
                    <input type="email" name="email" class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Masukkan Alamat Email...">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user"
                        id="exampleInputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Ingatkan Saya</label>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
            <hr>
    
            <div class="text-center">
                <p>Belum Punya akun?</p>
                <a class="small t-0" href="{{ route('register')}}">Register Sekarang!</a>
            </div>
        </div>
    </div>
</div>
@endsection