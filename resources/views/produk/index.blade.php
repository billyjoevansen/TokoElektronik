@extends('app')

@section('content')

<h3>Data Produk</h3>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(request('search'))
    <div class="alert alert-info">
        Hasil pencarian untuk: <strong>{{ request('search') }}</strong>
        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-secondary ml-2">
            Reset
        </a>
    </div>
@endif

<div class="row mb-3 align-items-center justify-content-between">
    <!-- Grup Kiri: Menggunakan Margin Right (mr-3) sebagai pengganti gap -->
    <div class="col-md-8 d-flex align-items-center">
        <a href="{{ route('produk.create') }}" class="btn btn-primary mr-3">
            + Tambah Produk
        </a>

        <form method="GET" action="{{ route('produk.index') }}" class="form-inline">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <label class="mr-2">Tampilkan</label>
            <select name="perPage" onchange="this.form.submit()" class="form-control form-control-sm mr-2">
                @foreach([5, 10, 25] as $val)
                    <option value="{{ $val }}" {{ $perPage == $val ? 'selected' : '' }}>{{ $val }}</option>
                @endforeach
            </select>
            <span class="font-weight-bold">data</span>
        </form>
    </div>

    <!-- Grup Kanan -->
    <div class="col-md-4 text-right">
        <a href="{{ route('produk.laporan.pdf', request()->query()) }}" class="btn btn-primary">
            ➜] Generate Report
        </a>
    </div>
</div>


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Thumbnail</th>
            <th>Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>
                {{ $products->firstItem() + $loop->index }}
            </td>
            <td>
                @if($p->thumbnail)
                    <img src="/uploads/{{$p->thumbnail}}" width="100">
                @else
                    Tidak ada gambar
                @endif
            </td>
            <td>{{ $p->nama_produk }}</td>
            <td>{{ $p->kategori }}</td>
            <td>Rp {{ number_format($p->harga) }}</td>
            <td>
                <a href="{{ route('produk.edit',$p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('produk.destroy',$p->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus produk?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-between align-items-center mt-3">

    <div>
        Menampilkan {{ $products->firstItem() }}
        sampai {{ $products->lastItem() }}
        dari {{ $products->total() }} data
    </div>

    <div>
        {{ $products->links() }}
    </div>

</div>


@endsection
