@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>SatoeTrack | @yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="{{asset('bs/css/bootstrap.min.css')}}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('styles_top')
    @include('layout.styles.style')
    <style>

    </style>
</head>

<body id="body-pd">
    @if (!request()->is('login'))
    <header class="header" id="header">
        <div class="header_left">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <a class="header_text" href="{{ url('/') }}" class="nav_link {{ request()->is('/') ? 'active' : '' }}">SatoeTrack✓</a>
        </div>
        <div class="d-flex-jend gap-5">
            <a href="{{ route('logout') }}" class="nav_link mb-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out nav_icon' style="color: red"></i>
                <span class="text-danger fs-5">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class="header_img">
                <img src="{{ asset('assets/logo/smkn1.png') }}" alt="logo" style="width: 100%; height: 100%;">
            </div>
        </div>
    </header>
    <!-- Sidebar -->
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <img src="{{ asset('assets/icon/avatar.svg') }}" class="nav-logo-avatar" alt="Avatar">
                    <span class="nav_logo-name fw-bold fs-5">{{ Str::limit(authUser()->nama ?? 'Guest', 12, '...') }}</span>
                </a>
                <div class="nav_list">
                    <!-- Simple nav links -->
                    <a href="{{ url('/') }}" class="nav_link {{ request()->is('/') ? 'active' : '' }}">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-box nav_icon'></i>
                        <span class="nav_name">Kelola Barang</span>
                    </a>

                    <!-- Accordion Menu 1 -->
                    @if (Auth::guard('admin')->check()) 
                    <div class="nav_accordion">
                        <a href="#" class="nav_link accordion-toggle">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Kelola Akun</span>
                            <i class='bx bx-chevron-down nav_accordion-icon'></i>
                        </a>
                        <div class="accordion-menu">
                            <a href="{{ url('/kelola-peminjam') }}" class="nav_link sub-link {{ request()->is('/kelola-peminjam') ? 'active' : '' }}">
                                <i class='bx bx-user-plus nav_icon'></i>
                                <span class="nav_name">Kelola Peminjam</span>
                            </a>
                            <a href="{{ url('/kelola-admin') }}" class="nav_link sub-link {{ request()->is('/kelola-admin') ? 'active' : '' }}">
                                <i class='bx bx-group nav_icon'></i>
                                <span class="nav_name">Kelola Admin</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Accordion Menu 2 -->
                    <div class="nav_accordion">
                        <a href="#" class="nav_link accordion-toggle">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name">Messages</span>
                            <i class='bx bx-chevron-down nav_accordion-icon'></i>
                        </a>
                        <div class="accordion-menu">
                            <a href="#" class="nav_link sub-link">
                                <i class='bx bx-envelope nav_icon'></i>
                                <span class="nav_name">Inbox</span>
                            </a>
                            <a href="#" class="nav_link sub-link">
                                <i class='bx bx-send nav_icon'></i>
                                <span class="nav_name">Sent</span>
                            </a>
                            <a href="#" class="nav_link sub-link">
                                <i class='bx bx-edit nav_icon'></i>
                                <span class="nav_name">Compose</span>
                            </a>
                        </div>
                    </div>

                    <!-- Regular links -->
                    <a href="#" class="nav_link">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Bookmarks</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">Files</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Statistics</span>
                    </a>
                </div>
                <a href="{{ route('logout') }}" class="nav_link mb-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out nav_icon' style="color: red"></i>
                    <span class="nav_name text-danger fs-5">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>
    </div>
    @endif
    <main>
        @if (!request()->is('login'))
        <h1 class="msr-font secondary-color px-2">
            Welcome, <span class="fw-bolder">{{ authUser()->nama ?? 'Guest' }}</span> 👋
        </h1>
        @endif
        @yield('content')
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('scripts_bottom')
    <script src="{{asset('bs/js/bootstrap.min.js')}}"></script>
    @include('layout.scripts.script')

    <script>
        $(document).ready(function() {
            $('.data-table').DataTable({
                // searchable: true,
                // fixedHeight: true,
                // fixedHeader: true,
                // fixedHeaderOffset: 56,
                // fixedHeaderOffset: 56,
                // sortable: true,
                // fixedColumns: true,
                // fixedColumnsLeft: 1,
                // fixedColumnsRight: 0,
                // perPageSelect: true,
                // perPage: 10,
                // perPageSelect: [5, 10, 20, 50, 100],
                // labels: {
                // placeholder: "Cari...",
                // perPage: "{select}",
                // noRows: "Tidak ada data",
                // info: "Menampilkan {start} sampai {end} dari {rows} baris",
                // },
            });

            $('.select2').select2();

            $('.dropify').dropify();
        });

        <?php if (session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "<?php echo session('success'); ?>",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if (session('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "<?php echo session('error'); ?>",
                showConfirmButton: true
            });
        <?php endif; ?>

        <?php if ($errors->any()): ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                html: `
        <ul style='text-align: center; list-style-type: none; padding: 0;'>
            <?php foreach ($errors->all() as $error): ?>
            <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        `,
            });
        <?php endif; ?>
    </script>
</body>

</html>