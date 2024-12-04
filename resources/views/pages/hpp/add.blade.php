@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Debts'])
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Add HPP</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('hpp.add.perform') }}" enctype="multipart/form-data" id="hppAddForm">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="initial_stock" class="form-label">Initial Stock</label>
                                            <input type="number" name="initial_stock" id="initial_stock" class="form-control" placeholder="Initial Stock">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="final_stock" class="form-label">Final Stock</label>
                                            <input type="number" name="final_stock" id="final_stock" class="form-control" placeholder="Final Stock">
                                        </div>
                                    </div>
        
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="purchase_amount" class="form-label">Purchase Amount</label>
                                            <input type="number" name="purchase_amount" id="purchase_amount" class="form-control" placeholder="Purchase Amount">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="shipping_cost" class="form-label">Shipping Cost</label>
                                            <input type="number" name="shipping_cost" id="shipping_cost" class="form-control" placeholder="Shipping Cost">
                                        </div>
                                    </div>
        
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="purchase_return" class="form-label">Purchase Return</label>
                                            <input type="number" name="purchase_return" id="purchase_return" class="form-control" placeholder="Purchase Return">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="purchase_discount" class="form-label">Purchase Discount</label>
                                            <input type="number" name="purchase_discount" id="purchase_discount" class="form-control" placeholder="Purchase Discount">
                                        </div>
                                    </div>
        
                                    <div class=" row">
                                        <div class="col-md">
                                            <label for="sales_return" class="form-label">Sales Return</label>
                                            <input type="number" name="sales_return" id="sales_return" class="form-control" placeholder="Sales Return">
                                        </div>
                                        <div class="col-md">
                                            <label for="sales_revenue" class="form-label">Sales Revenue</label>
                                            <input type="number" name="sales_revenue" id="sales_revenue" class="form-control" placeholder="Sales Revenue">
                                        </div>
                                    </div>
        
                                    <div class="mb-3 row">
                                        <div class="col-md">
                                            <label for="sales_shipping_cost" class="form-label">Sales Shipping Cost</label>
                                            <input type="number" name="sales_shipping_cost" id="sales_shipping_cost" class="form-control" placeholder="Sales Shipping Cost">
                                        </div>
                                        <div class="col-mb">
                                            <label for="sales_discount" class="form-label">Sales Discount</label>
                                            <input type="number" name="sales_discount" id="sales_discount" class="form-control" placeholder="Sales Discount">
                                        </div>
                                    </div>
        
                                    <div class="mb-3 row">
                                        <div class="col-mb-6">
                                            <label for="sales_discount" class="form-label">Sales Discount</label>
                                            <input type="number" name="sales_discount" id="sales_discount" class="form-control" placeholder="Sales Discount">
                                        </div>
                                    </div>
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