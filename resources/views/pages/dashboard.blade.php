@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">       
        <div class="row">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
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
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Sales overview</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        display: true, // Menghilangkan sumbu Y
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
