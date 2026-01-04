@extends('layout.main')

@section('content')
    {{-- Hero Section --}}
        <header class="masthead position-relative vh-100 overflow-hidden mb-4">
            <img src="{{ asset('/') }}assets/img/bg-home.png" class="position-absolute top-0 start-0 w-100 h-100 obect-fit-cover z-0" alt="">
            <div class="container h-100 d-flex flex-column justify-content-center align-items-start text-center position-relative z-1 text-primary">
                <div class="masthead-subheading">
                    <h1>Welcome To Our FoundIT!</h1>
                </div>
                <div class="masthead-heading">
                    <p>Miliki Kembali Barang Kesayanganmu!</p>
                </div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#about">Selengkapnya</a>
            </div>
        </header>
    {{-- End of Hero Section --}}

    {{-- about section --}}
    <section class="page-section mb-4 bg-primary" id="about">
        <div class="container">
            <div class="d-flex flex-column justify-content-center align-items-center text-center m-3 vh-100">
                <h2 class="section-heading text-uppercase text-white">About Found IT</h2>
                <p class="section-subheading text-white">FoundIT adalah platform daring yang didedikasikan untuk membantu kamu 
                    menemukan barang-barang yang hilang dan memfasilitasi pengembalian barang-barang tersebut kepada pemiliknya. 
                    Dengan menggunakan teknologi canggih dan jaringan komunitas yang luas, FoundIT bertujuan untuk mengurangi 
                    kehilangan barang dan meningkatkan peluang pengembalian barang kepada pemiliknya dengan cara yang efisien 
                    dan terpercaya.</p>
            </div>
        </div>
    </section>
    {{-- end of about section --}}

    <!-- Services-->
        <section class="page-section pt-3 min-vh-100" id="services">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-heading text-uppercase">Cara Kerja Found IT</h2>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-cloud-upload-alt fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Upload</h4>
                        <p class="text-muted">
                            Kamu dapat mengunggah informasi tentang barang yang kamu temukan atau kehilangan melalui platform FoundIT.
                        </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-search fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Cari</h4>
                        <p class="text-muted">Kami akan mencarikan barang yang kamu temukan atau kehilangan berdasarkan informasi yang kamu berikan.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-hand-holding-heart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-4">Klaim</h4>
                        <p class="text-muted">Kamu dapat mengklaim barang yang kamu temukan atau kehilangan melalui platform FoundIT.</p>
                    </div>
                </div>
            </div>
        </section>
    {{-- end of services section --}}

    {{-- Quotes Section --}}
    <section class="page-section bg-primary" id="about">
            <div class="d-flex flex-column justify-content-center align-items-center text-center min-vh-100">
                <img src="{{ asset('/') }}assets/img/quotes.svg" class="top-0 start-0 w-100 h-100 obect-fit-cover z-0" alt="">
            </div>
    </section>
@endsection