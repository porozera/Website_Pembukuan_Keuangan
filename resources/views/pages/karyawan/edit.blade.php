@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Karyawan'])
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0"><b>Edit Karyawan</b></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="/karyawan/edit/{{$karyawan['id']}}/perform" enctype="multipart/form-data" id="karyawanEditForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emailInput" class="form-control-label">Email</label>
                                        <input class="form-control" type="text" name="email" placeholder="Ex: Jennifer Roxane" value="{{ $karyawan['email'] }}">
                                        @error('email') 
                                            <p class="text-danger text-xs pt-1"> {{$message}} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roleInput" class="form-control-label">Role</label>
                                        <input class="form-control" type="text" name="role" placeholder="Ex: Admin" value="{{ $karyawan['role'] }}">
                                        @error('role') 
                                            <p class="text-danger text-xs pt-1"> {{$message}} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usernameInput" class="form-control-label">Username</label>
                                        <input class="form-control" type="text" name="username" placeholder="Ex: jenifer123" value="{{ $karyawan['username'] }}">
                                        @error('username') 
                                            <p class="text-danger text-xs pt-1"> {{$message}} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="passwordInput" class="form-control-label">Password</label>
                                        <input class="form-control" type="text" name="password" placeholder="Ex: ********" value="{{ $karyawan['password'] }}">
                                        @error('password') 
                                            <p class="text-danger text-xs pt-1"> {{$message}} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="salaryInput" class="form-control-label">Gaji</label>
                                        <input class="form-control" type="text" name="gaji" placeholder="Ex: 3500000" value="{{ $karyawan['gaji'] }}">
                                        @error('gaji') 
                                            <p class="text-danger text-xs pt-1"> {{$message}} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editModal">
                                            Update
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
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menyimpan perubahan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="submitFormButton">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submitFormButton').addEventListener('click', function () {
            document.getElementById('karyawanEditForm').submit();
        });
    </script>
@endsection
