@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">       
        <div class="row">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card card-hover z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Pemasukan & Pengeluaran</h6>
                        <p class="text-sm mb-0">
                            <div class="row">
                                <div class="col">
                                    <i class="fa fa-arrow-up text-success"></i><span class=""> Total</span>
                                </div>
                                <div class="col text-end">
                                    <h5><b>{{ number_format($grandTotal, 0) }}</b></h5>
                                </div>
                            </div> 
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <a href="/transaction" class="text-primary href-hover">Tampilkan detail <i class="ni ni-bold-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card card-hover z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Hutang</h6>
                        <p class="text-sm mb-0">
                            <div class="row">
                                <div class="col">
                                    <i class="fa fa-arrow-up text-primary"></i><span class=""> Total Hutang</span>
                                </div>
                                <div class="col text-end">
                                    <h5><b>{{ number_format($grandDebtsTotal, 0) }}</b></h5>
                                </div>
                            </div>
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-debts" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <a href="/debt_receivable" class="text-primary href-hover">Tampilkan detail <i class="ni ni-bold-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grafik Piutang -->
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card card-hover z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Piutang</h6>
                        <p class="text-sm mb-0">
                            <div class="row">
                                <div class="col">
                                    <i class="fa fa-arrow-up text-warning"></i><span class=""> Total Piutang</span>
                                </div>
                                <div class="col text-end">
                                    <h5><b>{{ number_format($grandReceivablesTotal, 0) }}</b></h5>
                                </div>
                            </div>
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-receivables" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <a href="/debt_receivable" class="text-primary href-hover">Tampilkan detail <i class="ni ni-bold-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var labels = @json($labels); // Label berupa tanggal
        var totals = @json($totals); // Total per tanggal
    
        var ctx = document.getElementById("chart-line").getContext("2d");
    
        new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    borderColor: "#4CAF50",
                    backgroundColor: "rgba(76, 175, 80, 0.2)",
                    data: totals,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        display: true,
                        beginAtZero: true,
                        grid: { drawBorder: true, borderDash: [5, 5] }
                    },
                    x: {
                        grid: { drawBorder: false, display: false }
                    }
                }
            }
        });
    
        // Grafik Hutang
        var debtLabels = @json($debtLabels); // Label untuk hutang
        var debtTotals = @json($debtTotals); // Total per tanggal untuk hutang
    
        var ctx2 = document.getElementById("chart-debts").getContext("2d");
    
        new Chart(ctx2, {
            type: "line",
            data: {
                labels: debtLabels,
                datasets: [{
                    borderColor: "#2196f3", // Warna garis grafik hutang
                    backgroundColor: "rgba(33, 150, 243, 0.2)", // Warna latar belakang grafik hutang
                    data: debtTotals, // Data hutang
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Menyembunyikan legenda
                    }
                },
                scales: {
                    y: {
                        display: true,
                        beginAtZero: true,
                        grid: {
                            drawBorder: true, // Menggambar garis pada sumbu Y
                            borderDash: [5, 5] // Garis putus-putus pada grid
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false
                        }
                    }
                }
            }
        });
    
        // Grafik Piutang
        var receivableLabels = @json($receivableLabels); // Label untuk piutang
        var receivableTotals = @json($receivableTotals); // Total per tanggal untuk piutang
    
        var ctx3 = document.getElementById("chart-receivables").getContext("2d"); // Gunakan ctx3 untuk Piutang
    
        new Chart(ctx3, {
            type: "line",
            data: {
                labels: receivableLabels,
                datasets: [{
                    borderColor: "#FFC107", // Warna garis grafik piutang
                    backgroundColor: "rgba(255, 193, 7, 0.2)", // Warna latar belakang grafik piutang
                    data: receivableTotals, // Data piutang
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        display: true,
                        beginAtZero: true,
                        grid: { drawBorder: true, borderDash: [5, 5] }
                    },
                    x: {
                        grid: { drawBorder: false, display: false }
                    }
                }
            }
        });
    </script>
    
    
    
    
@endpush
