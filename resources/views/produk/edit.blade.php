@extends('app')

@section('content')

<h3>Edit Produk</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Kategori</label>
        <input type="text" name="kategori" value="{{ $produk->kategori }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Harga</label>
        <input type="number" name="harga" value="{{ $produk->harga }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Thumbnail</label>
        @if($produk->thumbnail)
            <br>
            <img src="/uploads/{{$produk->thumbnail}}" width="100">
        @endif
        <input type="file" name="thumbnail" class="form-control mt-2">
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
