@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Neraca Saldo'])
    <div class="container-fluid py-4">
        @if(session('success'))
        <div class="alert alert-success" role="alert" id="successMessage">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <form method="GET" action="{{ route('reports.neraca') }}">
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
                                    <a href="{{ route('reports.neraca.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success ms-2">
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
                                            Saldo Debit
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Saldo Kredit
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($neraca as $item)
                                        <tr>
                                            <td class="align-middle text-start text-sm px-3">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item['code'] }}</p>
                                            </td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item['account'] }}</p>
                                            </td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item['debit'], 0, ',', '.') }}</p>
                                            </td>
                                            <td class="align-middle text-start text-sm px-3">
                                                <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item['credit'], 0, ',', '.') }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="align-middle text-start text-sm px-3"></td>
                                        <td class="align-middle text-start text-sm px-3"><b>Total</b></td>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b>Rp. {{ number_format($totalDebit, 0, ',', '.') }}</b>
                                        </td>
                                        <td class="align-middle text-start text-sm px-3">
                                            <b>Rp. {{ number_format($totalKredit, 0, ',', '.') }}</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                  
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection