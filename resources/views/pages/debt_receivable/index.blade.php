@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Hutang Piutang'])
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
                                <h6><b>Tabel Hutang Piutang</b></h6>
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
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'invoice', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Invoice
                                                <i class="fa {{ request('sort') === 'invoice' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>

                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'contact', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Kontak
                                                <i class="fa {{ request('sort') === 'contact' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>

                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'type', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Tipe
                                                <i class="fa {{ request('sort') === 'type' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Tanggal
                                                <i class="fa {{ request('sort') === 'date' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'due_date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Jatuh Tempo
                                                <i class="fa {{ request('sort') === 'due_date' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'amount', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Jumlah
                                                <i class="fa {{ request('sort') === 'amount' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'paid_amount', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Dibayar
                                                <i class="fa {{ request('sort') === 'paid_amount' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'rest_amount', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Sisa
                                                <i class="fa {{ request('sort') === 'rest_amount' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Status
                                                <i class="fa {{ request('sort') === 'status' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Description
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $number = ($debt_receivable->currentPage() - 1) * $debt_receivable->perPage() + 1; 
                                    @endphp
                                    @forelse ($debt_receivable as $item )
                                    <tr>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$number++}}</p>
                                        </td>

                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['invoice']}}</p>
                                        </td>

                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['contact']?? '-'}}</p>
                                        </td>

                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['type']}}</p>
                                        </td>

                                        <td class="align-middle text-center px-3">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item['date']}}</span>
                                        </td>

                                        <td class="align-middle text-center px-3">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item['due_date']?? '-'}}</span>
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item['amount'], 0, ',', '.')}}</p>
                                        </td>

                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item['paid_amount'], 0, ',', '.')}}</p>
                                        </td>

                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item['rest_amount'], 0, ',', '.')}}</p>
                                        </td>

                                        <td class="align-middle text-center px-3">
                                            @if ($item['status'] == 'Pending')
                                                <span class="badge badge-sm bg-gradient-warning">{{$item['status']}}</span>
                                            @elseif ($item['status'] == 'Paid')
                                                <span class="badge badge-sm bg-gradient-success">{{$item['status']}}</span>
                                            @elseif ($item['status'] == 'UnPaid')
                                                <span class="badge badge-sm bg-gradient-danger">{{$item['status']}}</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">No Status</span>
                                            @endif
                                            
                                        </td>

                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['description']}}</p>
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <a href="/debt_receivable/edit/{{$item['id']}}" class="text-primary font-weight-bold text-xs me-3"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                <b>Bayar</b>
                                            </a>
                                            <form action="/debt_receivable/delete/{{ $item['id'] }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteModal" style="border:none;background:none;" data-id="{{ $item['id'] }}">
                                                    <b>Delete</b>
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td colspan="10" class="text-center">Tidak ada data yang tersedia.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $debt_receivable->links('vendor.pagination.bootstrap-5') }}
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
                deleteForm = document.querySelector(`form[action="/debt_receivable/delete/${id}"]`);
            });
        });

        document.getElementById('submitFormButton').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
@endsection