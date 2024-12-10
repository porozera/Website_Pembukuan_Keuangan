@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Debts'])
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">

                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="{{ route('hpp.add.perform') }}" enctype="multipart/form-data" id="hppAddForm">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3 row">
                                        <h7><b>Production</b></h7>
                                    </div>

                                    {{-- Stock --}}
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <label for="product_id">Product</label>
                                            <select class="form-control" id="product_id" name="product_id" required>
                                                <option value="">Choose Product</option>
                                                @foreach ($product as $item)
                                                    <option value="{{ $item->id }}" {{ old('product_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                    @error('product_id') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="production_cost" class="form-label">Production Cost</label>
                                            <input type="number" name="production_cost" id="production_cost" class="form-control" placeholder="Rp">
                                            @error('production_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="quantity_produced" class="form-label">Quantity Produced</label>
                                            <input type="number" name="quantity_produced" id="quantity_produced" class="form-control" placeholder="Qty">
                                            @error('quantity_produced') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="initial_stock" class="form-label">Initial Stock</label>
                                            <input type="number" name="initial_stock" id="initial_stock" class="form-control" placeholder="Qty">
                                            @error('initial_stock') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="final_stock" class="form-label">Final Stock</label>
                                            <input type="number" name="final_stock" id="final_stock" class="form-control" placeholder="Qty">
                                            @error('final_stock') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    {{-- Sales --}}
                                    <div class="mb-3 row">
                                        <h7><b>Sales</b></h7>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="price_per_unit" class="form-label">Price Per Unit</label>
                                            <input type="number" name="price_per_unit" id="price_per_unit" class="form-control" placeholder="Rp">
                                            @error('price_per_unit') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sales_return" class="form-label">Sales Return</label>
                                            <input type="number" name="sales_return" id="sales_return" class="form-control" placeholder="Rp">
                                            @error('sales_return') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="sales_shipping_cost" class="form-label">Sales Shipping Cost</label>
                                            <input type="number" name="sales_shipping_cost" id="sales_shipping_cost" class="form-control" placeholder="Rp">
                                            @error('sales_shipping_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sales_discount" class="form-label">Sales Discount</label>
                                            <input type="number" name="sales_discount" id="sales_discount" class="form-control" placeholder="Rp">
                                            @error('sales_discount') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group text-end">
                                                <button type="button" class="btn btn-primary btn-sm w-20" data-bs-toggle="modal" data-bs-target="#addModal">
                                                    Add
                                                </button>
                                            </div>
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
                document.getElementById('hppAddForm').submit();
            });
        </script>
@endsection