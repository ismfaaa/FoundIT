

@extends('layout.main')

@section('content')
    <div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="p-4">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register Untuk Masuk!</h1>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="user" action="/register" method="post">
            @csrf
                <div class="form-group mb-2">
                    <input type="text" class="form-control form-control-user"
                        id="exampleInputName" aria-describedby="nameHelp" name="username"
                        placeholder="Masukkan Username...">
                </div>
                <div class="form-group mb-2">
                    <input type="email" class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                        placeholder="Masukkan Alamat Email...">
                </div>
                <div class="form-group mb-2">
                    <input type="password" class="form-control form-control-user" name="password"
                        id="exampleInputPassword" placeholder="Password teridiri dari 8 karakter">
                </div>
                <div class="form-group mb-2">
                    <input type="password" class="form-control form-control-user" 
                        name="password_confirmation" placeholder="Ulangi Password...">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Ingatkan Saya</label>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Register
                    </button>
                
            </form>
            <hr>

        </div>
    </div>
</div>
@endsection