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

        <div class="col-md-3">
            <div class="card text-primary bg-light border-left border-primary" style="border-left-width: 5px !important;">
                <div class="card-body">
                    <i class="fas fa-wallet position-absolute" style="font-size: 60px; opacity: 0.1; right: 20px; top: 50%; transform: translateY(-50%);"></i>
                    <h6z>Total Nilai Produk</h6z>
                    <h5 class="text-body">Rp {{ number_format(\App\Models\Product::sum('harga')) }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-success bg-light border-left border-success" style="border-left-width: 5px !important;">
                <div class="card-body">
                    <i class="fas fa-rupiah-sign position-absolute" style="font-size: 60px; opacity: 0.1; right: 20px; top: 50%; transform: translateY(-50%);"></i>
                    <h6>Penghasilan</h6>
                    <h5 class="text-body">Rp {{ number_format(rand(1000000, 7000000), 0, '.', ',') }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-info bg-light border-left border-info" style="border-left-width: 5px !important;">
                <div class="card-body">
                    <i class="fas fa-box position-absolute" style="font-size: 60px; opacity: 0.1; right: 20px; top: 50%; transform: translateY(-50%);"></i>
                    <h6>Total Produk</h6>
                    <h5 class="text-body">{{ $totalProduk }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-warning bg-light border-left border-warning" style="border-left-width: 5px !important;">
                <div class="card-body">
                    <i class="fas fa-tags position-absolute" style="font-size: 60px; opacity: 0.1; right: 20px; top: 50%; transform: translateY(-50%);"></i>
                    <h6>Total Kategori</h6>
                    <h5 class="text-body">{{ $totalKategori }}</h5>
                </div>
            </div>
        </div>

    </div>

<div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Tren Produk
            </div>
            <div class="card-body" style="height: 400px;">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Distribusi Kategori
            </div>
            <div class="card-body" style="height: 400px;">
                <canvas id="donutChart"></canvas>
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
            <div class="card-body" style="height: 400px;">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>

</div>

<!-- CHART SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
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
    },
    options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
    legend: {
        position: 'bottom'
        }
    }
}

});

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
    },
    options: {
    responsive: true,
    maintainAspectRatio: false,
}

});

</script>

@endsection
