<!DOCTYPE html>
<html>
<head>
    <title>Login - Admin Toko</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .login-wrapper
        {
        position: fixed;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all .3s ease;
        }
    </style>
</head>

<body class="hold-transition login-page login-wrapper">

<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">

            {{ $slot }}

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: 'Email atau password salah!',
        confirmButtonColor: '#d33'
    });
</script>
@endif
</body>
</html>
