@extends('layout.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row">
        <!-- Card 1: Total Barang -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Total Barang</h5>
                            <h2 class="mb-0">1,234</h2>
                        </div>
                        <i class="fas fa-boxes fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('barang.index') }}">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Card 2: Stok Minimum -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Stok Minimum</h5>
                            <h2 class="mb-0">56</h2>
                        </div>
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Card 3: Barang Masuk -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Barang Masuk</h5>
                            <h2 class="mb-0">42</h2>
                        </div>
                        <i class="fas fa-arrow-down fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Card 4: Barang Keluar -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Barang Keluar</h5>
                            <h2 class="mb-0">78</h2>
                        </div>
                        <i class="fas fa-arrow-up fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Grafik -->
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Grafik Transaksi Bulan Ini
                </div>
                <div class="card-body">
                    <canvas id="transactionChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-history me-1"></i>
                    Aktivitas Terbaru
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <div class="activity-item mb-3">
                            <div class="activity-text">
                                <strong>Admin</strong> menambahkan barang baru <strong>Laptop Dell XPS</strong>
                                <div class="text-muted small">2 menit yang lalu</div>
                            </div>
                        </div>
                        <div class="activity-item mb-3">
                            <div class="activity-text">
                                <strong>Admin</strong> mengupdate stok <strong>Mouse Wireless</strong>
                                <div class="text-muted small">15 menit yang lalu</div>
                            </div>
                        </div>
                        <div class="activity-item mb-3">
                            <div class="activity-text">
                                <strong>Kasir</strong> melakukan transaksi penjualan
                                <div class="text-muted small">1 jam yang lalu</div>
                            </div>
                        </div>
                        <div class="activity-item mb-3">
                            <div class="activity-text">
                                <strong>Gudang</strong> menerima barang masuk <strong>Keyboard Mechanical</strong>
                                <div class="text-muted small">3 jam yang lalu</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-text">
                                <strong>Admin</strong> menghapus barang <strong>Speaker Bluetooth</strong>
                                <div class="text-muted small">5 jam yang lalu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grafik Transaksi
        var ctx = document.getElementById('transactionChart').getContext('2d');
        var transactionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                datasets: [{
                    label: 'Barang Masuk',
                    data: [5, 10, 8, 12, 6, 9, 7, 14, 10, 8, 12, 9, 11, 7, 13, 10, 8, 12, 6, 9, 7, 14, 10, 8, 12, 9, 11, 7, 13, 10],
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }, {
                    label: 'Barang Keluar',
                    data: [3, 7, 5, 9, 4, 6, 8, 10, 7, 5, 8, 6, 9, 5, 11, 7, 5, 8, 4, 6, 8, 10, 7, 5, 8, 6, 9, 5, 11, 7],
                    backgroundColor: 'rgba(220, 53, 69, 0.2)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection