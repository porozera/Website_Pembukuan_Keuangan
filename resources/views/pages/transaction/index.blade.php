@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Transaction'])
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
                        <div class="row">
                            <div class="col d-flex justify-content-between align-items-center">
                                <h6>Transaction table</h6>
                                <button class="btn btn-primary btn-sm">
                                    <a href="/transaction/add" class="text-white">
                                        Add Transaction <i class="fa fa-plus"></i>
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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                No
                                                <i class="fa {{ request('sort') === 'id' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Date
                                                <i class="fa {{ request('sort') === 'date' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'transaction_type', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Transaction Type
                                                <i class="fa {{ request('sort') === 'transaction_type' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'amount', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Amount
                                                <i class="fa {{ request('sort') === 'amount' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Description
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'category', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Category
                                                <i class="fa {{ request('sort') === 'category' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $number = ($transaction->currentPage() - 1) * $transaction->perPage() + 1; 
                                    @endphp
                                    @foreach ($transaction as $item )
                                    <tr>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$number++}}</p>
                                        </td>
    
                                        <td class="align-middle text-center px-3">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item['date']}}</span>
                                        </td>

                                        <td class="align-middle text-center px-3">
                                            @if ($item['transaction_type'] == 'Pengeluaran')
                                                <span class="text-xs font-weight-bold mb-0">{{$item['transaction_type']}}</span>
                                            @elseif ($item['transaction_type'] == 'Pemasukan')
                                                <span class="text-xs font-weight-bold mb-0">{{$item['transaction_type']}}</span>
                                            @else
                                                <span class="text-xs font-weight-bold mb-0">No Status</span>
                                            @endif
                                            
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['amount']}}</p>
                                        </td>

                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['description']}}</p>
                                        </td>

                                        <td class="align-middle text-center px-3">
                                            @if ($item['category'] == 'Pembelian bahan baku')
                                                <span class="text-xs font-weight-bold mb-0">{{$item['category']}}</span>
                                            @elseif ($item['category'] == 'Biaya operasional')
                                                <span class="text-xs font-weight-bold mb-0">{{$item['category']}}</span>
                                            @elseif ($item['category'] == 'Penjualan')
                                                <span class="text-xs font-weight-bold mb-0">{{$item['category']}}</span>
                                            @elseif ($item['category'] == 'Pendapatan tambahan')
                                                <span class="text-xs font-weight-bold mb-0">{{$item['category']}}</span>
                                            @else
                                                <span class="text-xs font-weight-bold mb-0">No Status</span>
                                            @endif
                                            
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <a href="/transaction/edit/{{$item['id']}}" class="text-primary font-weight-bold text-xs me-3"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                            <form action="/transaction/delete/{{ $item['id'] }}" method="POST" style="display:inline;" id="transactionDeleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteModal" style="border:none;background:none;">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $transaction->links('vendor.pagination.bootstrap-5') }}
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
        document.getElementById('submitFormButton').addEventListener('click', function () {
                document.getElementById('transactionDeleteForm').submit();
        });
    </script>
@endsection