@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Karyawan'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0"><b>Tambah Data Karyawan</b></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('karyawan.add.perform') }}" id="karyawanAddForm">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <!-- Nama -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="form-control-label">Name</label>
                                        <input class="form-control" type="text" name="username" placeholder="username" value="{{ old('username') }}">
                                        @error('username') <p class="text-danger text-xs pt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <!-- Role -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role" class="form-control-label">Role</label>
                                        <select class="form-control" name="role">
                                            <option value="" selected disabled>Choose Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="editor">Editor</option>
                                            <option value="viewer">Viewer</option>
                                        </select>
                                        @error('role') <p class="text-danger text-xs pt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <!-- Gaji -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gaji" class="form-control-label">Gaji</label>
                                        <input class="form-control" type="number" step="0.01" name="gaji" placeholder="Rp" value="{{ old('gaji') }}">
                                        @error('gaji') <p class="text-danger text-xs pt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menambahkan data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="submitFormButton">Ya, Tambahkan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submitFormButton').addEventListener('click', function () {
            document.getElementById('karyawanAddForm').submit();
        });
    </script>
@endsection
