<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Found IT</title>
    <link rel="icon" href="{{ asset('/') }}assets/img/Logo-FoundIT.svg" favicon.ico">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('/') }}assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/') }}assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body id="page-top">
    <!-- Navbar -->
        @include('components.navbar')
    <!-- End of Navbar -->

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @auth
            @if(Auth::user()->role === 'admin')
                @include('components.sidebar') 
            @endif
        @endauth
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Begin Page Content -->
            <!-- Main Content -->
            <div id="content" class="ms-4">
                @yield(section:'content')
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; FoundIT 2026</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/') }}assets/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/') }}assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/') }}assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('/') }}assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('/') }}assets/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('/') }}assets/js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cek apakah ada session success
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                width: '350px', 
                padding: '1em', 
                color: '#716add',
                showConfirmButton: false,
                timer: 3000 // Otomatis hilang dalam 3 detik
            });
        @endif

        // Cek apakah ada session error (opsional buat validasi gagal)
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Waduh...',
                text: "{{ session('error') }}",
                width: '350px', 
                padding: '1em', 
                color: '#716add',
            });
        @endif

        // untuk warning khusus logout
        @if(session('warning'))
        Toast.fire({
            icon: 'warning',
            title: "{{ session('warning') }}"
        });
        @endif  

        // untuk emote welcome
        @if(session('welcome'))
        Swal.fire({
            text: "{{ session('welcome') }}",
            width: '350px',
            showConfirmButton: false,
            timer: 3000
        });
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>