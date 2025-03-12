<!doctype html>
<html lang="en">

<head>
    <title>SatoeTrack | </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="{{asset('bs/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">


    @stack('styles_top')
    @include('layout.styles.style')
    <style>

    </style>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_left">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_text">SatoeTrack✓</div>
        </div>
        <div class="header_img"> <img src="{{ asset('assets/smkn1.png') }}" alt="logo"> </div>
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <div class="d-flex align-items-center p-3">
                    <a href="#" class="nav_logo">
                        <img src="{{ asset('assets/avatar.png') }}" width="50" height="50" alt="Avatar">
                        <span class="nav_logo-name ms-3 fw-bold fs-5">Ian</span>
                    </a>
                </div>
                <div class="nav_list"> <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> <a href="#" class="nav_link"> <i class="bx bx-history nav_icon"></i>
                        <span class="nav_name">Riwayat pinjam</span> </a></div>
            </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Log Out</span> </a>
        </nav>
    </div>
    <main>
        @yield('content')
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="{{asset('bs/js/bootstrap.min.js')}}"></script>
    @stack('scripts_bottom')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>
    <div class="container">
        <div class="welcome">
            <a href="" class="arrow">
            <i class="bx bx-left-arrow-alt"></i>
            </a>
            <h1>Pilih Jurusan</h1>
        </div>



        <div class="container mt-5">
            <!-- Baris Pertama: 3 Card -->
            <div class="row">
                <div class="col-md-4 mb-4 ">
                    <a href="" class="card p-4">
                        <div class="line"></div>
                        <h2 class="jurusan">Pengembangan perangkat lunak dan gim</h2>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="" class="card p-4">
                        <div class="line"></div>
                        <h2 class="jurusan">Teknik komputer jaringan</h2>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="" class="card p-4">
                        <div class="line"></div>
                        <h2 class="jurusan">Desain Komunikasi Visual</h2>
                    </a>
                </div>
            </div>

            <!-- Baris Kedua: 3 Card -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a href="" class="card p-4">
                        <div class="line"></div>
                        <h2 class="jurusan">Teknik Kendaraan Ringan</h2>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="" class="card p-4">
                        <div class="line"></div>
                        <h2 class="jurusan">Teknik Permesinan</h2>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="" class="card p-4">
                        <div class="line"></div>
                        <h2 class="jurusan">Teknik Pengelasan</h2>
                    </a>
                </div>
            </div>

            <!-- Baris Ketiga: 2 Card Ditengah -->
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <a href="" class="card p-4">
                        <div class="line"></div>
                        <h2 class="jurusan">Busana Butik</h2>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="" class="card p-4">
                        <div class="line"></div>
                        <h2 class="jurusan">Akuntansi</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>