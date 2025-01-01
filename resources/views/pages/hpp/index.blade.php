@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Harga Pokok Penjualan'])
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
                        <div class="row">
                            <div class="col d-flex justify-content-between align-items-center">
                                <h6><b>Tabel Harga Pokok Penjualan</b></h6>
                                <button class="btn btn-primary btn-sm btn-hover">
                                    <a href="/hpp/add" class="text-white">
                                        Tambah HPP <i class="fa fa-plus"></i>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                No
                                                <i class="fa {{ request('sort') === 'id' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Nama Produk
                                                <i class="fa {{ request('sort') === 'id' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_production_cost', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Biaya Produksi Per Unit
                                                <i class="fa {{ request('sort') === 'total_production_cost' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'hpp', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                HPP
                                                <i class="fa {{ request('sort') === 'hpp' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'gross_profit', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Laba Kotor
                                                <i class="fa {{ request('sort') === 'gross_profit' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'sales_revenue', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Pendapatan Penjualan
                                                <i class="fa {{ request('sort') === 'sales_revenue' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'recommended_price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Harga Rekomendasi
                                                <i class="fa {{ request('sort') === 'recommended_price' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Tanggal
                                                <i class="fa {{ request('sort') === 'created_at' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                    
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $number = ($hpp->currentPage() - 1) * $hpp->perPage() + 1; 
                                    @endphp
                                    @foreach ($hpp as $item )
                                    <tr class="tr-hover"> 
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$number++}}</p>
                                        </td>
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item->product->name}}</p>
                                        </td>
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item['price_per_unit'], 0, ',', '.')}}</p>
                                        </td>
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item['hpp'], 0, ',', '.')}}</p>
                                        </td>
    
                                        <td class="align-middle text-start px-3">
                                            <span class="text-secondary text-xs font-weight-bold">Rp. {{ number_format($item['gross_profit'], 0, ',', '.')}}</span>
                                        </td>
                                        <td class="align-middle text-start px-3">
                                            <span class="text-secondary text-xs font-weight-bold">Rp. {{ number_format($item['sales_revenue'], 0, ',', '.')}}</span>
                                        </td>
                                        <td class="align-middle text-start px-3">
                                            <span class="text-secondary text-xs font-weight-bold">Rp. {{ number_format($item['recommended_price'], 0, ',', '.')}}</span>
                                        </td>

                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->created_at->format('d-m-Y') }}</p>
                                        </td>
    
                                        <td class="align-middle text-start text-sm px-3">
                                            <a href="/hpp/detail/{{$item['id']}}" class="text-primary font-weight-bold text-xs me-3 href-hover"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                <b>Detail</b>
                                            </a>
                                            <form action="/hpp/delete/{{ $item['id'] }}" method="POST" style="display:inline;" id="debtDeleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-danger font-weight-bold text-xs href-hover" data-bs-toggle="modal" data-bs-target="#deleteModal" style="border:none;background:none;" data-id="{{ $item['id'] }}">
                                                    <b>Delete</b>
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $hpp->links('vendor.pagination.bootstrap-5') }}
                            </div>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Are you sure to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="submitFormButton">Delete</button>
            </div>
        </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
        const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteModal"]');
        let deleteForm = null;

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                deleteForm = document.querySelector(`form[action="/hpp/delete/${id}"]`);
            });
        });

        document.getElementById('submitFormButton').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
@endsection