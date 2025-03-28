<!DOCTYPE html>
<html lang="en">

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
    @stack('styles_top')
    @include('layout.styles.style')
    <style>

    </style>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_left">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <a class="header_text" href="{{ url('/') }}" class="nav_link {{ request()->is('/') ? 'active' : '' }}">SatoeTrack✓</a>
        </div>
        <div class="header_img">
            <img src="{{ asset('assets/smkn1.png') }}" alt="logo" style="width: 100%; height: 100%;">
        </div>
    </header>
    <!-- Sidebar -->
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <img src="{{ asset('assets/avatar.png') }}" class="nav-logo-avatar" alt="Avatar">
                    <span class="nav_logo-name fw-bold fs-5">Ian Sopian</span>
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
                    <div class="nav_accordion">
                        <a href="#" class="nav_link accordion-toggle">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">Users</span>
                            <i class='bx bx-chevron-down nav_accordion-icon'></i>
                        </a>
                        <div class="accordion-menu">
                            <a href="#" class="nav_link sub-link">
                                <i class='bx bx-user-plus nav_icon'></i>
                                <span class="nav_name">Add User</span>
                            </a>
                            <a href="{{ url('/kelola-admin') }}" class="nav_link sub-link {{ request()->is('/kelola-admin') ? 'active' : '' }}">
                                <i class='bx bx-group nav_icon'></i>
                                <span class="nav_name">Add Admin</span>
                            </a>
                            <a href="#" class="nav_link sub-link">
                                <i class='bx bx-user-check nav_icon'></i>
                                <span class="nav_name">Permissions</span>
                            </a>
                        </div>
                    </div>

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
                    <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Statistics</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Statistics</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-log-out nav_icon'></i>
                        <span class="nav_name">Log out</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <main>
        <h1 class="msr-font secondary-color px-2">Welcome, <span class="fw-bolder">Ian Sopian</span></h1>
        @yield('content')
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        });

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
        @endif

        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            html: `
        <ul style='text-align: left; list-style-type: none; padding: 0;'>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        `,
        });
        @endif
    </script>
</body>

</html>