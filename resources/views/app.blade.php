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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                            <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2M3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                            <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.95 11.95 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0"/>
                        </svg>
                        <p class="ml-2">Dashboard</p>
                    </a>
                </li>

                <li class="nav-item rounded {{ request()->routeIs('produk.index') ? 'bg-light' : '' }}">
                    <a href="{{ route('produk.index') }}" class="nav-link text-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks-grid" viewBox="0 0 16 16">
                            <path d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1m9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1m0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0z"/>
                        </svg>
                        <p class="ml-2">Produk</p>
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

{{-- Sweet Alert Plugin --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif
<script>
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            let form = this.closest("form");

            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
<script>
document.getElementById("btn-edit").addEventListener("click", function () {

    Swal.fire({
        title: "Simpan perubahan?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, simpan",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("form-edit").submit();
        }
    });

});
</script>

</body>
</html>
