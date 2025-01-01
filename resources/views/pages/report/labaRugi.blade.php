@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laba Rugi'])
    <div class="container-fluid py-4">
        @if(session('success'))
        <div class="alert alert-success" role="alert" id="successMessage">
            {{ session('success') }}
        </div>
        @endif
        <div class="row mb-5">
            <div class="col-12">
                <div class="card mb-4 card-hover">
                    <div class="card-header pb-0">
                        <form method="GET" action="{{ route('reports.labarugi') }}">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="start_date" class="form-control-label">Tanggal Awal</label>
                                        <input class="form-control" type="date" name="start_date" id="start_date" value="{{ request('start_date', $startDate->toDateString()) }}">
                                        @error('start_date') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="end_date" class="form-control-label">Tanggal Akhir</label>
                                        <input class="form-control" type="date" name="end_date" id="end_date" value="{{ request('end_date', $endDate->toDateString()) }}">
                                        @error('end_date') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="col-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('reports.labarugi.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success ms-2">
                                        Export Excel
                                    </a>
                                </div>
                            </div>
                       </form>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Kode
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Akun
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td><b>Pendapatan dari Penjualan</b></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @if ($pendapatan->isNotEmpty())
                                        @foreach ($pendapatan as $akun)
                                        <tr>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['code'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['name'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">Rp. {{ number_format($akun['total'], 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-start"><b>Total Pendapatan dari Penjualan</b></td>
                                            <td></td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <b>Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                    @else
                                    <tr>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3">Tidak ada data pendapatan.</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td  class="text-start"><b>Total Pendapatan dari Penjualan</b></td>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3"><b>Rp. 0</b></td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>     
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>  
                                    </tr>

                                    <tr>
                                        <td >
                                            <b>Harga Pokok Penjualan</b>
                                        </td>     
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>                        
                                    </tr>
                                    @if ($hargaPokokPenjualan->isNotEmpty())
                                        @foreach ($hargaPokokPenjualan as $akun)
                                        <tr>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['code'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['name'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">Rp. {{ number_format($akun['total'], 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-start"><b>Total Harga Pokok Penjualan</b></td>
                                            <td></td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <b>Rp. {{ number_format($totalHargaPokokPenjualan, 0, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start"><b>Laba Kotor</b></td>
                                            <td></td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <b>Rp. {{ number_format($labaKotor, 0, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                    @else
                                    <tr>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3">Tidak ada data harga pokok penjualan.</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td  class="text-start"><b>Total Pendapatan dari Penjualan</b></td>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3"><b>Rp. 0</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-start"><b>Laba Kotor</b></td>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b>Rp. {{ number_format($labaKotor, 0, ',', '.') }}</b>
                                        </td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>     
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>  
                                    </tr>

                                    <tr>
                                        <td >
                                            <b>Beban Operasional</b>
                                        </td>     
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>                        
                                    </tr>
                                    @if ($bebanOperasional->isNotEmpty())
                                        @foreach ($bebanOperasional as $akun)
                                        <tr>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['code'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['name'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">Rp. {{ number_format($akun['total'], 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-start"><b>Total Beban Operasional</b></td>
                                            <td></td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <b>Rp. {{ number_format($totalBebanOperasional, 0, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start"><b>Laba Beban Operasional</b></td>
                                            <td></td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <b>Rp. {{ number_format($labaBebanOperasional, 0, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                    @else
                                    <tr>
                                        <td></td>
                                        <td  class="text-start">Tidak ada data beban operasional.</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td  class="text-start"><b>Total Beban Operasional</b></td>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3"><b>Rp. 0</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-start"><b>Laba Beban Operasional</b></td>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b>Rp. {{ number_format($labaBebanOperasional, 0, ',', '.') }}</b>
                                        </td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>     
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>  
                                    </tr>

                                    <tr>
                                        <td >
                                            <b>Pendapatan Lainnya</b>
                                        </td>     
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>                        
                                    </tr>
                                    @if ($pendapatanLainnya->isNotEmpty())
                                        @foreach ($pendapatanLainnya as $akun)
                                        <tr>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['code'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['name'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">Rp. {{ number_format($akun['total'], 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-start"><b>Total Pendapatan Lainnya</b></td>
                                            <td></td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <b>Rp. {{ number_format($totalPendapatanLainnya, 0, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                    @else
                                    <tr>
                                        <td></td>
                                        <td  class="text-start">Tidak ada data pendapatan lainnya.</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td  class="text-start"><b>Total Pendapatan Lainnya</b></td>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3"><b>Rp. 0</b></td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>     
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>  
                                    </tr>

                                    <tr>
                                        <td >
                                            <b>Beban Lainnya</b>
                                        </td>     
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <b></b>
                                        </td>                        
                                    </tr>
                                    @if ($bebanLainnya->isNotEmpty())
                                        @foreach ($bebanLainnya as $akun)
                                        <tr>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['code'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">{{ $akun['name'] }}</td>
                                            <td class="align-middle text-start text-sm px-3">Rp. {{ number_format($akun['total'], 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-start"><b>Total Beban Lainnya</b></td>
                                            <td></td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <b>Rp. {{ number_format($totalBebanLainnya, 0, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start"><b>Laba Bersih</b></td>
                                            <td></td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <b>Rp. {{ number_format($labaBersih, 0, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                    @else
                                    <tr>
                                        <td></td>
                                        <td  class="text-start">Tidak ada data beban lainnya.</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td  class="text-start"><b>Total Beban Lainnya</b></td>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3"><b>Rp. 0</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-start"><b>Laba Bersih</b></td>
                                        <td></td>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b>Rp. {{ number_format($labaBersih, 0, ',', '.') }}</b>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                        </table>                         
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection