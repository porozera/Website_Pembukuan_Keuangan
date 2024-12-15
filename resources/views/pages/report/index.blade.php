@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Financial Report'])
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
                                <h6><b>Financial Report Table</b></h6>
                                <button class="btn btn-primary btn-sm">
                                    <a href="/report/add" class="text-white">
                                        Add Report <i class="fa fa-plus"></i>
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
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_sales', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Total Sales
                                                <i class="fa {{ request('sort') === 'total_sales' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_hpp', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Total HPP
                                                <i class="fa {{ request('sort') === 'total_hpp' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_debt', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Total Debt
                                                <i class="fa {{ request('sort') === 'total_debt' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_receivable', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Total Receivable
                                                <i class="fa {{ request('sort') === 'total_receivable' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'net_profit', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Net Profit
                                                <i class="fa {{ request('sort') === 'net_profit' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'report_date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Report Date
                                                <i class="fa {{ request('sort') === 'report_date' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                    
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $number = ($report->currentPage() - 1) * $report->perPage() + 1; 
                                    @endphp
                                    @foreach ($report as $item )
                                    <tr> 
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$number++}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['total_Sales']}}</p>
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['total_hpp']}}</p>
                                        </td>
    
                                        <td class="align-middle text-center px-3">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item['total_debt']}}</span>
                                        </td>

                                        <td class="align-middle text-center px-3">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item['total_receivable']}}</span>
                                        </td>

                                        <td class="align-middle text-center px-3">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item['net_profit']}}</span>
                                        </td>

                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->report_date->format('d-m-Y') }}</p>
                                        </td>
    
                                        <td class="align-middle text-center text-sm px-3">
                                            <a href="/report/detail/{{$item['id']}}" class="text-primary font-weight-bold text-xs me-3"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                Detail
                                            </a>
                                            <form action="/report/delete/{{ $item['id'] }}" method="POST" style="display:inline;" id="debtDeleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteModal" style="border:none;background:none;" data-id="{{ $item['id'] }}">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $report->links('vendor.pagination.bootstrap-5') }}
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
                deleteForm = document.querySelector(`form[action="/report/delete/${id}"]`);
            });
        });

        document.getElementById('submitFormButton').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
@endsection