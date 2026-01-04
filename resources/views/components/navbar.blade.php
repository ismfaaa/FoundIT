            <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light sticky-top bg-white topbar mb-0 static-top shadow">
                    {{-- @if(Auth::check())
                    <h1>sudah login{{ Auth::user()->username }}</h1>
                    
                        
                    @else
                        <h1>tamu</h1>
                    @endif --}}
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('/') }}assets/img/Logo-FoundIT.svg" alt="Logo" width="40" height="34" class="d-inline-block align-text-center">
                        FoundIT
                        </a>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        {{-- Nav item (features) --}}
                        <li class="nav-item mx-2">
                            <a class="nav-link text-primary" href="{{ route('home') }}">Home</a>
                        </li>
                        
                    {{-- gerbang agar hanya user yang sudah login yang bisa akses fitur --}}
                    @auth
                        <li class="nav-item mx-2">
                            <a class="nav-link text-primary" href="{{ route('items.index') }}">Item</a>
                        </li>
                        <!-- Nav Item - Upload Item -->                       
                        <li class="nav-item dropdown no-arrow mx-2">
                            <a class="nav-link dropdown-toggle text-primary" href="" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Upload                                    
                            </a>
                            <!-- Dropdown - Upload Item -->
                            <div class="dropdown-menu dropdown-menu-center shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                {{-- rujukan route ke 1 file upload tapi ada parameternya karena ada temuan dan kehilangan barang --}}
                                <a class="dropdown-item" href="{{ route('upload', ['type' => 'Temuan']) }}">
                                    Posting Temuan
                                </a>
                                <a class="dropdown-item" href="{{ route('upload', ['type' => 'Kehilangan']) }}">
                                    Posting Kehilangan
                                </a>
                            </div>
                        </li>                        
                        {{-- End of Nav item (features) --}}

                        <!-- Nav Item - Alerts Verivication -->
                        <li class="nav-item dropdown no-arrow mx-2">
                            <a class="nav-link" href="{{ route('verification') }}" id="alertsDropdown" role="button"aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-2">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-comment-dots"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::user()->foto_user ? asset('storage/foto/' . Auth::user()->foto_user) : asset('assets/img/undraw_profile.svg') }}">
                                    
                            </a>
                            

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('activity') }}">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Activity
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="/logout" method="POST">
                                    @csrf    
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    
                    
                    @else
                        <li class="d-flex align-items-center">
                            <a href="{{ route('login') }}" class="nav-link">
                                <button class="btn btn-primary btn-sm">Login</button>
                            </a> 
                        </li>
                    @endauth

                    </ul>

                </nav>
                <!-- End of Topbar -->