<!DOCTYPE html>
<html>
<head>
    <title>Laporan Produk</title>
    <style>
        body { font-family: sans-serif; }
        table { width:100%; border-collapse: collapse; }
        table, th, td { border:1px solid black; }
        th, td { padding:8px; text-align:left; }
        th { background:#f2f2f2; }
    </style>
</head>
<body>

<h2 style="text-align:center;">LAPORAN DATA PRODUK</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama Produk</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->kategori }}</td>
            <td>{{ $p->nama_produk }}</td>
            <td>Rp {{ number_format($p->harga) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>
<p>Total Produk: {{ $products->count() }}</p>

</body>
</html>
