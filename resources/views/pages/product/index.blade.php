@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Produk'])
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
                                <h6><b>Tabel Produk</b></h6>
                                <button class="btn btn-primary btn-sm btn-hover">
                                    <a href="/product/add" class="text-white">
                                        <i class="fa fa-plus"></i>
                                        Tambah Produk 
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
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                                Nama
                                                <i class="fa {{ request('sort') === 'name' ? (request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></i>
                                            </a>
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Deskrpisi
                                        </th>
                                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $number = ($product->currentPage() - 1) * $product->perPage() + 1; 
                                    @endphp
                                    @foreach ($product as $item )
                                    <tr class="tr-hover">
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$number++}}</p>
                                        </td>
    
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item['name']}}</p>
                                        </td>
    
                                        <td class="align-middle text-start text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$item['description']}}</p>
                                        </td>
    
                                        <td class="align-middle text-start text-sm px-3">
                                            <a href="/product/edit/{{$item['id']}}" class="text-primary font-weight-bold text-xs me-3 href-hover"
                                               data-toggle="tooltip" data-original-title="Edit">
                                                <b>Edit</b>
                                            </a>
                                            <form action="/product/delete/{{ $item['id'] }}" method="POST" style="display:inline;">
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
                                {{ $product->links('vendor.pagination.bootstrap-5') }}
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
                deleteForm = document.querySelector(`form[action="/product/delete/${id}"]`);
            });
        });

        document.getElementById('submitFormButton').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
@endsection