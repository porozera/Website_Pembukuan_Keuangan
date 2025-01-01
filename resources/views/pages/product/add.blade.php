@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Produk'])
        <div class="container">
            <div class="row mb-5">
                <div class="col">
                    <div class="card card-hover">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0"><b>Tambah Produk</b></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('product.add.perform') }}" enctype="multipart/form-data" id="productAddForm">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amountInput" class="form-control-label">Nama Produk</label>
                                            <input class="form-control" type="text" name="name" placeholder="Co : Kripik Jamur">
                                            @error('name') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="due_date" class="form-control-label">Deskripsi</label>
                                            <textarea class="form-control" type="text" name="description" placeholder="Co : Kripik Jamur berat 900 gram"></textarea>
                                            @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary btn-sm w-100 btn-hover" data-bs-toggle="modal" data-bs-target="#addModal">
                                                Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Apakah anda yakin menambah data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitFormButton">Save Changes</button>
                </div>
            </div>
            </div>
        </div>
        <script>
            document.getElementById('submitFormButton').addEventListener('click', function () {
                // Submit the form
                document.getElementById('productAddForm').submit();
            });
        </script>
@endsection