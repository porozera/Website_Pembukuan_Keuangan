@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Akun'])
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0"><b>Tambah Akun</b></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('account.add.perform') }}" enctype="multipart/form-data" id="accountAddForm">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="accounNameInput" class="form-control-label">Nama Akun</label>
                                                <input class="form-control" type="text" name="name" placeholder="Ex : Kas">
                                                @error('name') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="accountInput" class="form-control-label">Kode Akun</label>
                                                <input class="form-control" type="text" name="code" placeholder="Ex : 1-10001">
                                                @error('code') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="categoryInput" class="form-control-label">Kategori</label>
                                                <select class="form-control" name="category">
                                                    <option selected>Pilih Kategori</option>
                                                    <option value="Kas & Bank">Kas & Bank</option>
                                                    <option value="Akun Piutang">Akun Piutang</option>
                                                    <option value="Persediaan">Persediaan</option>
                                                    <option value="Harta Lancar Lainnya">Harta Lancar Lainnya</option>
                                                    <option value="Harta Tetap">Harta Tetap</option>
                                                    <option value="Depresiasi & Armotisasi">Depresiasi & Armotisasi</option>
                                                    <option value="Akun Hutang">Harta Lainnya</option>
                                                    <option value="Akun Hutang">Akun Hutang</option>
                                                    <option value="Kewajiban Lancar Lainnya">Kewajiban Lancar Lainnya</option>
                                                    <option value="Modal">Modal</option>
                                                    <option value="Pendapatan">Pendapatan</option>
                                                    <option value="Harga Pokok Penjualan">Harga Pokok Penjualan</option>
                                                    <option value="Beban">Beban</option>
                                                    <option value="Pendapatan Lainnya">Pendapatan Lainnya</option>
                                                    <option value="Beban Lainnya">Beban Lainnya</option>
                                                </select>
                                                @error('category') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="typeInput" class="form-control-label">Tipe Akun</label>
                                                <select class="form-control" name="account_type">
                                                    <option selected>Pilih Tipe Akun</option>
                                                    <option value="Debit">Debit</option>
                                                    <option value="Credit">Credit</option>
                                                </select>
                                                @error('account_type') <p class="text-danger text-xs pt-1">{{$message}}</p> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description" class="form-control-label">Description</label>
                                                <textarea class="form-control" type="text" name="description" placeholder=""></textarea>
                                                @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#addModal">
                                                    Add
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
                Are you sure to add this data?
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
                document.getElementById('accountAddForm').submit();
            });
        </script>
@endsection