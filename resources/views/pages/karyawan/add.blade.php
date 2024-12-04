@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Data Karyawan'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Tambah Data Karyawan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('karyawan.create') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Karyawan" required>

                            </div>
                            <div class="form-group">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="" disabled selected>Choose Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Editor">Editor</option>
                                    <option value="Viewer">Viewer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="salary" class="form-label">Gaji</label>
                                <input type="number" name="salary" id="salary" class="form-control" placeholder="Rp" required>
                            </div>
                            <div class="form-group my-3">
                                <button type="button" class="btn btn-secondary" id="generateBtn">Generate Username dan Password</button>
                                <div id="generatedData" class="mt-2"></div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Save</button>
                                <a href="{{ route('karyawan.index') }}" class="btn btn-light">Cancel</a>
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
                                            Tambah Data Karyawan?
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

    <script>
        // Generate Username dan Password
        document.getElementById('generateBtn').addEventListener('click', function () {
            const username = 'user' + Math.floor(Math.random() * 1000);
            const password = Math.random().toString(36).slice(-8);
            document.getElementById('generatedData').innerHTML = `
                <p>Username: <strong>${username}</strong></p>
                <p>Password: <strong>${password}</strong></p>
            `;
        });
    </script>
@endsection
