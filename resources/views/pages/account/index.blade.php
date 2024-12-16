@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Akun'])
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
                                <h6><b>Tabel Akun</b></h6>
                                <button class="btn btn-primary btn-sm">
                                    <a href="/account/add" class="text-white">
                                        <i class="fa fa-plus"></i>
                                        Tambah Akun 
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
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'code', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Kode
                                                <i class="fa {{ request('sort') === 'code' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Nama
                                                <i class="fa {{ request('sort') === 'name' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'category', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Kategori
                                                <i class="fa {{ request('sort') === 'category' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'account_type', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Tipe Akun
                                                <i class="fa {{ request('sort') === 'account_type' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Description
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $number = ($account->currentPage() - 1) * $account->perPage() + 1; 
                                    @endphp
                                    @foreach ($account as $item )
                                    <tr>
    
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item['code']}}</p>
                                        </td>
    
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['name']}}</p>
                                        </td>

                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['category']}}</p>
                                        </td>

                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['account_type']}}</p>
                                        </td>

                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['description']}}</p>
                                        </td>
    
                                        <td class="align-middle text-start text-sm px-3">
                                            <a href="/account/edit/{{$item['id']}}" class="text-primary font-weight-bold text-xs me-3"
                                               data-toggle="tooltip" data-original-title="Edit">
                                                <b>Edit</b>
                                            </a>
                                            <form action="/account/delete/{{ $item['id'] }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteModal" style="border:none;background:none;" data-id="{{ $item['id'] }}">
                                                    <b>Delete</b>
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $account->links('vendor.pagination.bootstrap-5') }}
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
                deleteForm = document.querySelector(`form[action="/account/delete/${id}"]`);
            });
        });

        document.getElementById('submitFormButton').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
@endsection