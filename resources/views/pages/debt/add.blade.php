@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Debts'])
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Add Debts</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('debt.add.perform') }}" enctype="multipart/form-data" id="debtAddForm">
                                    @csrf
                                    @method('POST')
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
                                            <label for="interest_rate" class="form-control-label">Interest Rate</label>
                                            <input class="form-control" type="number" name="interest_rate" placeholder="%">
                                            @error('interest_rate') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="due_date" class="form-control-label">Due Date</label>
                                            <input class="form-control" type="date" name="due_date">
                                            @error('due_date') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="statusInput" class="form-control-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option selected>Select Status</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Unpaid">Unpaid</option>
                                            </select>
                                            @error('status') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="due_date" class="form-control-label">Description</label>
                                            <textarea class="form-control" type="text" name="description"></textarea>
                                            @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                    </div>
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
                document.getElementById('debtAddForm').submit();
            });
        </script>
@endsection