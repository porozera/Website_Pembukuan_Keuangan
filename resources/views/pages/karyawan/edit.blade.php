@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Data Karyawan'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Edit Data Karyawan</h6>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('karyawan.edit.perform', $karyawan->id) }}" enctype="multipart/form-data" id="karyawanEditForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $karyawan->nama) }}" required>
                                @error('nama') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="Admin" {{ $karyawan->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Editor" {{ $karyawan->role == 'Editor' ? 'selected' : '' }}>Editor</option>
                                    <option value="Viewer" {{ $karyawan->role == 'Viewer' ? 'selected' : '' }}>Viewer</option>
                                </select>
                                @error('role') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="salary" class="form-label">Gaji</label>
                                <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary', $karyawan->salary) }}" placeholder="Rp" required>
                                @error('salary') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Save Changes</button>
                                <a href="{{ route('karyawan') }}" class="btn btn-light">Cancel</a>
                            </div>

                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin mengubah data karyawan ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-primary">Ya</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
