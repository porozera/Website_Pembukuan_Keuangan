@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kelola Karyawan'])
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
                                <h6><b>Data Karyawan</b></h6>
                                <button class="btn btn-primary btn-sm">
                                    <a href="/karyawan/add" class="text-white">
                                        <i class="fa fa-plus"></i>
                                        Tambah Karyawan
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" style="table-layout: auto; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">No</th>
                                        <th style="width: 20%;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">Nama</th>
                                        <th style="width: 15%;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">Role</th>
                                        <th style="width: 15%;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">Username</th>
                                        <th style="width: 20%;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">Password</th>
                                        <th style="width: 15%;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">Gaji</th>
                                        <th style="width: 10%;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $number = ($karyawan->currentPage() - 1) * $karyawan->perPage() + 1; 
                                    @endphp
                                    @foreach ($karyawan as $item)
                                    <tr>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{$number++}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item['nama'] }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item['role'] }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item['username'] }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm px-3">
                                            <div class="password-group">
                                                <input 
                                                    type="password" 
                                                    class="form-control form-control-sm text-xs font-weight-bold mb-0" 
                                                    value="{{ $item['password'] }}" 
                                                    id="password-{{ $item['id'] }}" 
                                                    readonly>
                                                <button 
                                                    class="btn btn-sm btn-outline-secondary toggle-password" 
                                                    type="button" 
                                                    data-id="{{ $item['id'] }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm px-3">
                                            <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($item['gaji'], 0, ',', '.') }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm px-3">
                                            <a href="/karyawan/edit/{{$item['id']}}" class="text-primary font-weight-bold text-xs me-3"
                                               data-toggle="tooltip" data-original-title="Edit">
                                                <b>Edit</b>
                                            </a>
                                            <form action="/karyawan/delete/{{ $item['id'] }}" method="POST" style="display:inline;" id="karyawanDeleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteModal" style="border:none;background:none;">
                                                    <b>Delete</b>
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer">
                                {{ $karyawan->links('vendor.pagination.bootstrap-5') }}
                            </div>                            
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
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="submitFormButton">Hapus</button>
            </div>
        </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function () {
                    const passwordInput = document.getElementById('password-' + this.dataset.id);
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Success message timeout
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }

            // Handle delete form submission
            document.getElementById('submitFormButton').addEventListener('click', function () {
                document.getElementById('karyawanDeleteForm').submit();
            });
        });
    </script>
    <style>
        .password-group {
            display: flex;
            align-items: center;
        }
        .password-group input {
            flex: 1;
            margin-right: 5px;
        }
        .password-group button {
            padding: 0 8px;
        }
    </style>
@endsection
