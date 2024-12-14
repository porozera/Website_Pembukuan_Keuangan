@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Debts'])
        <div class="container">
            <div class="container">
                <div class="row">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert" id="successMessage">
                        {{ session('success') }}
                    </div>
                    @endif
                    <!-- Card 1 -->
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                        Bayar
                                    </button>                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="amountInput" class="form-control-label">Status</label>
                                        <input class="form-control" type="text" name="status" placeholder="" value="{{$debt_receivable->status}}" disabled readonly>
                                        @error('status') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="amountInput" class="form-control-label">Jatuh Tempo</label>
                                        <input class="form-control" type="date" name="due_date" placeholder="" value="{{$debt_receivable->due_date}}" disabled readonly>
                                        @error('due_date') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="amountInput" class="form-control-label">Total</label>
                                        <input class="form-control" type="text" name="amount" placeholder="" value="Rp. {{ number_format($debt_receivable['amount'], 0, ',', '.')}}" disabled readonly>
                                        @error('amount') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="amountInput" class="form-control-label">Dibayar</label>
                                        <input class="form-control" type="text" name="paid_amount" placeholder="" value=" Rp. {{ number_format($debt_receivable['paid_amount'], 0, ',', '.')}}" disabled readonly>
                                        @error('paid_amount') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="amountInput" class="form-control-label">Sisa yang harus dibayar</label>
                                        <input class="form-control" type="text" name="rest_amount" placeholder="" value="Rp. {{ number_format($debt_receivable['rest_amount'], 0, ',', '.')}}" disabled readonly>
                                        @error('rest_amount') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="col-7">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col d-flex justify-content-between align-items-center">
                                        <h6><b>Data Pembayaran</b></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                                    No
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                                    Kode
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                                    Tanggal
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                                    Dibayar
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                                    Catatan
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 px-3">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @php
                                                $number = 1;
                                            @endphp
                                            @foreach ($payment as $item )
                                            <tr>
                                                <td class="align-middle text-center text-sm px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{$number++}}</p>
                                                </td>
            
                                                <td class="align-middle text-center text-sm px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $item['code']}}</p>
                                                </td>
            
                                                <td class="align-middle text-center text-sm px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{$item['date']}}</p>
                                                </td>

                                                <td class="align-middle text-center text-sm px-3">
                                                    <p class="text-xs font-weight-bold mb-0">RP. {{ number_format($item['paid_amount'], 0, ',', '.')}}</p>
                                                </td>

                                                <td class="align-middle text-center text-sm px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{$item['description']}}</p>
                                                </td>
            
                                                <td class="align-middle text-center text-sm px-3">
                                                    <form action="/payment/delete/{{ $item['id'] }}" method="POST" style="display:inline;">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('debt_receivable.payment', $debt_receivable->id) }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="debts_receivables_id" value="{{ $debt_receivable->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Bayar Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="debt_receivable_id" value="{{ $debt_receivable->id }}">
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal Pembayaran</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="paid_amount" class="form-label">Jumlah Dibayar</label>
                        <input type="number" class="form-control" id="paid_amount" name="paid_amount" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="statusInput" class="form-control-label">Akun</label>
                            <select class="form-control" name="account">
                                @foreach ($account as $item)  
                                <option value="{{ $item['name'] . ' (' . $item['code'] . ')' }}">
                                    {{ $item['name'] . ' (' . $item['code'] . ')' }}
                                </option>
                                @endforeach
                            </select>
                            @error('status') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Catatan</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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
                deleteForm = document.querySelector(`form[action="/payment/delete/${id}"]`);
            });
        });

        document.getElementById('submitFormButton').addEventListener('click', function () {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
@endsection


