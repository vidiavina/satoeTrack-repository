<!DOCTYPE html>
<html lang="en">

<head>
    <title>SatoeTrack | </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


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
    <!-- Sidebar -->
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">BBBootstrap</span>
                </a>
                <div class="nav_list">
                    <!-- Simple nav links -->
                    <a href="#" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
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
                            <a href="#" class="nav_link sub-link">
                                <i class='bx bx-group nav_icon'></i>
                                <span class="nav_name">User Groups</span>
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
                </div>
            </div>
            <a href="#" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">Log out</span>
            </a>
        </nav>
    </div>
    <main>
        @yield('content')
        <h1>hello!</h1>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    @stack('scripts_bottom')
    @include('layout.scripts.script')
</body>

</html>