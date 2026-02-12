@extends('app')

@section('content')

<h3>Tambah Produk</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control">
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
