@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detail HPP'])
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
                                        <div class="col-6">
                                            <h7><b>Detail</b></h7>
                                        </div>
                                        <div class="col-6 text-end">
                                                <button type="button" class="btn btn-primary btn-sm w-20">
                                                    <a href="/hpp/edit/{{$hpp['id']}}" class="text-white">
                                                        Edit <i class="fa fa-edit"></i>
                                                    </a>
                                                </button>
                                        </div>
                                    </div>

                                    {{-- Stock --}}
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <label for="product" class="form-label">Product</label>
                                            <input type="text" name="product" id="product" class="form-control" placeholder="Rp" value="{{$hpp->product->name}}" readonly>
                                            @error('product') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-md">
                                            <label for="sales_revenue" class="form-label">Sales Revenue</label>
                                            <input type="number" name="sales_revenue" id="sales_revenue" class="form-control" placeholder="Rp" value="{{$hpp->sales_revenue}}"  readonly>
                                            @error('sales_revenue') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md">
                                            <label for="hpp" class="form-label">HPP</label>
                                            <input type="number" name="hpp" id="hpp" class="form-control" placeholder="Rp" value="{{$hpp->hpp}}"  readonly>
                                            @error('hpp') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md">
                                            <label for="gross_profit" class="form-label">Gross Profit</label>
                                            <input type="number" name="gross_profit" id="gross_profit" class="form-control" placeholder="Rp" value="{{$hpp->gross_profit}}"   readonly>
                                            @error('gross_profit') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md">
                                            <label for="recommended_price" class="form-label">Recommended Price</label>
                                            <input type="number" name="recommended_price" id="recommended_price" class="form-control" placeholder="Rp" value="{{$hpp->recommended_price}}"  readonly>
                                            @error('recommended_price') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <h7><b>Production</b></h7>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="production_cost" class="form-label">Production Cost</label>
                                            <input type="number" name="production_cost" id="production_cost" class="form-control" placeholder="Rp" value="{{$hpp->production_cost}}" disabled readonly>
                                            @error('production_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="quantity_produced" class="form-label">Quantity Produced</label>
                                            <input type="number" name="quantity_produced" id="quantity_produced" class="form-control" placeholder="Qty" value="{{$hpp->quantity_produced}}"disabled readonly>
                                            @error('quantity_produced') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="initial_stock" class="form-label">Initial Stock</label>
                                            <input type="number" name="initial_stock" id="initial_stock" class="form-control" placeholder="Qty" value="{{$hpp->initial_stock}}" disabled readonly>
                                            @error('initial_stock') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="final_stock" class="form-label">Final Stock</label>
                                            <input type="number" name="final_stock" id="final_stock" class="form-control" placeholder="Qty" value="{{$hpp->final_stock}}" disabled readonly>
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
                                            <input type="number" name="price_per_unit" id="price_per_unit" class="form-control" placeholder="Rp" value="{{$hpp->price_per_unit}}" disabled readonly>
                                            @error('price_per_unit') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sales_return" class="form-label">Sales Return</label>
                                            <input type="number" name="sales_return" id="sales_return" class="form-control" placeholder="Rp" value="{{$hpp->sales_return}}"  disabled readonly>
                                            @error('sales_return') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="sales_shipping_cost" class="form-label">Sales Shipping Cost</label>
                                            <input type="number" name="sales_shipping_cost" id="sales_shipping_cost" class="form-control" placeholder="Rp" value="{{ $hpp->sales_shipping_cost}}"  disabled readonly>
                                            @error('sales_shipping_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sales_discount" class="form-label">Sales Discount</label>
                                            <input type="number" name="sales_discount" id="sales_discount" class="form-control" placeholder="Rp" value="{{ $hpp->sales_discount}}"  disabled readonly>
                                            @error('sales_discount') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
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