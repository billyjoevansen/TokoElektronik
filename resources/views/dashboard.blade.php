@extends('app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Dashboard Toko Elektronik</h1>
        <small class="text-muted">Sistem Informasi Penjualan</small>
    </div>
</div>

<div class="container-fluid">

    <!-- INFO BOX -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Produk</h5>
                    <h3>{{ $totalProduk }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Total Kategori</h5>
                    <h3>{{ $totalKategori }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Total Nilai Produk</h5>
                    <h3>Rp {{ number_format(\App\Models\Product::sum('harga')) }}</h3>
                </div>
            </div>
        </div>

    </div>

<div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Tren Produk
            </div>
            <div class="card-body">
                <canvas id="lineChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Distribusi Kategori
            </div>
            <div class="card-body">
                <canvas id="donutChart" height="100"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Grafik Produk per Kategori
            </div>
            <div class="card-body">
                <canvas id="barChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

</div>

<!-- CHART SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

// BAR CHART
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($kategori->keys()) !!},
        datasets: [{
            label: 'Jumlah Produk',
            data: {!! json_encode($kategori->values()) !!},
            backgroundColor: '#007bff'
        }]
    }
});

// LINE CHART
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($produkPerBulan->keys()) !!},
        datasets: [{
            label: 'Produk per Bulan',
            data: {!! json_encode($produkPerBulan->values()) !!},
            borderColor: '#28a745',
            fill: false,
            tension: 0.3
        }]
    }
});

// DONUT CHART
new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($kategori->keys()) !!},
        datasets: [{
            data: {!! json_encode($kategori->values()) !!},
            backgroundColor: [
                '#007bff',
                '#28a745',
                '#ffc107',
                '#dc3545',
                '#6f42c1'
            ]
        }]
    }
});

</script>

@endsection
