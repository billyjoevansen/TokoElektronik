<!DOCTYPE html>
<html>
<head>
    <title>Admin Toko Elektronik</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Search Form -->
    <form class="form-inline ml-3 flex-fill" method="GET" action="{{ route('produk.index') }}">
        <div class="input-group input-group-sm w-25">
            <input class="form-control form-control-navbar"
                   type="search"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari produk..."
                   aria-label="Search">

            <div class="input-group-append">
                <button class="btn btn-navbar bg-primary align-self-center" type="submit">
                    <svg width="18px" height="18px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff">
                        <g id="SVGRepo_iconCarrier">
                            <title>ionicons-v5-f</title>
                            <path d="M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z" style="fill:none;stroke:#ffffff;stroke-miterlimit:10;stroke-width:32px"></path>
                            <line x1="338.29" y1="338.29" x2="448" y2="448" style="fill:none;stroke:#ffffff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></line>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </form>

<ul class="navbar-nav ml-auto">
    @auth
    @php
        $userPhoto = auth()->user()->photo
            ? asset('uploads/'.auth()->user()->photo)
            : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name);
    @endphp

    <li class="nav-item dropdown">
        <a class="nav-link d-flex align-items-center"
           data-toggle="dropdown"
           href="#"
           role="button">

            <span class="mr-1">{{ auth()->user()->name }}</span>

            <i class="fas fa-caret-down mr-2" style="font-size: 0.8rem;"></i>

            <img src="{{ $userPhoto }}"
                 class="rounded-circle"
                 width="35"
                 height="35"
                 style="object-fit: cover; border: 1px solid #ddd;"
                 alt="User Image">
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">Logout</button>
            </form>
        </div>
    </li>
    @endauth
</ul>



</nav>


<!-- Sidebar -->
<aside class="main-sidebar bg-primary elevation-4">
    <a href="/" class="brand-link text-center text-white">
        <img src="/Smile.svg"
             class="rounded-circle"
             width="70"
             height="70">
        <span class="brand-text font-weight-bold">SB Admin</span>
    </a>

    <div class="sidebar">
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item rounded {{ request()->is('dashboard') ? 'bg-light' : '' }}">
                    <a href="/" class="nav-link text-light">
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item rounded {{ request()->routeIs('produk.index') ? 'bg-light' : '' }}">
                    <a href="{{ route('produk.index') }}" class="nav-link text-light">
                        <p>Produk</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Content -->
<div class="content-wrapper p-4">
    @yield('content')
</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
