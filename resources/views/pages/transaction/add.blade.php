@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Transaction'])
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Add Transaction</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('transaction.add.perform') }}" enctype="multipart/form-data" id="transactionAddForm">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                    <div class="col">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="due_date" class="form-control-label">Date</label>
                                                <input class="form-control" type="date" name="date">
                                                @error('date') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="transaction_typeInput" class="form-control-label">Transaction Type</label>
                                                <select class="form-control" name="transaction_type">
                                                    <option selected>Select Transaction Type</option>
                                                    <option value="Pemasukan">Pemasukan</option>
                                                    <option value="Pengeluaran">Pengeluaran</option>
                                                </select>
                                                @error('transaction_type') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="amountInput" class="form-control-label">Amount</label>
                                                    <input class="form-control" type="number" name="amount" placeholder="Rp.">
                                                    @error('amount') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="categoryInput" class="form-control-label">Category</label>
                                                    <select class="form-control" name="category">
                                                        <option selected>Select Category</option>
                                                        <option value="Pembelian bahan baku">Pembelian bahan baku</option>
                                                        <option value="Biaya operasional">Biaya operasional</option>
                                                        <option value="Penjualan">Penjualan</option>
                                                        <option value="Pendapatan tambahan">Pendapatan tambahan</option>
                                                    </select>
                                                    @error('category') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="due_date" class="form-control-label">Description</label>
                                                <textarea class="form-control" type="text" name="description"></textarea>
                                                @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                            </div>
                                        </div>
                                        <div class="form-group text-end">
                                            <button type="button" class="btn btn-primary btn-sm w-20" data-bs-toggle="modal" data-bs-target="#addModal">
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
                document.getElementById('transactionAddForm').submit();
            });
        </script>
@endsection