@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detail HPP'])
        <div class="container">
            <div class="row mb-5">
                <div class="col">
                    <div class="card card-hover">
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
                                            <h7><b>Detail HPP</b></h7>
                                        </div>
                                        <div class="col-6 text-end">
                                                <button type="button" class="btn btn-primary btn-sm w-20 btn-hover">
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
                                            <label for="sales_revenue" class="form-label">Pendapatan Penjualan</label>
                                            <input type="text" name="sales_revenue" id="sales_revenue" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['sales_revenue'], 0, ',', '.')}}"  readonly>
                                            @error('sales_revenue') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md">
                                            <label for="hpp" class="form-label">HPP</label>
                                            <input type="text" name="hpp" id="hpp" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['raw_material_cost'], 0, ',', '.')}}"  readonly>
                                            @error('hpp') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md">
                                            <label for="gross_profit" class="form-label">Laba Kotor</label>
                                            <input type="text" name="gross_profit" id="gross_profit" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['gross_profit'], 0, ',', '.')}}"   readonly>
                                            @error('gross_profit') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md">
                                            <label for="recommended_price" class="form-label">Rekomendasi Harga</label>
                                            <input type="text" name="recommended_price" id="recommended_price" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['recommended_price'], 0, ',', '.')}}"  readonly>
                                            @error('recommended_price') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <h7><b>Biaya Produksi</b></h7>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="raw_material_cost" class="form-label">Biaya Bahan Baku</label>
                                            <input type="text" name="raw_material_cost" id="raw_material_cost" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['raw_material_cost'], 0, ',', '.')}}" disabled readonly>
                                            @error('raw_material_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="labor_cost" class="form-label">Biaya Tenaga Kerja</label>
                                            <input type="text" name="labor_cost" id="labor_cost" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['labor_cost'], 0, ',', '.')}}" disabled readonly>
                                            @error('labor_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="overhead_cost" class="form-label">Biaya Operasional</label>
                                            <input type="text" name="overhead_cost" id="overhead_cost" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['overhead_cost'], 0, ',', '.')}}" disabled readonly>
                                            @error('overhead_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="packaging_cost" class="form-label">Biaya Pengemasan</label>
                                            <input type="text" name="packaging_cost" id="packaging_cost" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['packaging_cost'], 0, ',', '.')}}" disabled readonly>
                                            @error('packaging_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="other_production_costs" class="form-label">Biaya Produksi Lainnya</label>
                                            <input type="text" name="other_production_costs" id="other_production_costs" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['other_production_costs'], 0, ',', '.')}}" disabled readonly>
                                            @error('other_production_costs') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="quantity_produced" class="form-label">Quantity Produced</label>
                                            <input type="number" name="quantity_produced" id="quantity_produced" class="form-control" placeholder="Qty" value="{{ number_format($hpp['quantity_produced'], 0, ',', '.')}}"disabled readonly>
                                            @error('quantity_produced') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <h7><b>Stok Produk</b></h7>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="initial_stock" class="form-label">Initial Stock</label>
                                            <input type="number" name="initial_stock" id="initial_stock" class="form-control" placeholder="Qty" value="{{ number_format($hpp['initial_stock'], 0, ',', '.')}}" disabled readonly>
                                            @error('initial_stock') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="final_stock" class="form-label">Final Stock</label>
                                            <input type="number" name="final_stock" id="final_stock" class="form-control" placeholder="Qty" value="{{ number_format($hpp['final_stock'], 0, ',', '.')}}" disabled readonly>
                                            @error('final_stock') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>

                                    {{-- Sales --}}
                                    <div class="mb-3 row">
                                        <h7><b>Penjualan</b></h7>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="price_per_unit" class="form-label">Harga Per Produk</label>
                                            <input type="text" name="price_per_unit" id="price_per_unit" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['price_per_unit'], 0, ',', '.')}}" disabled readonly>
                                            @error('price_per_unit') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sales_return" class="form-label">Retur Penjualan</label>
                                            <input type="text" name="sales_return" id="sales_return" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['sales_return'], 0, ',', '.')}}"  disabled readonly>
                                            @error('sales_return') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="sales_shipping_cost" class="form-label">Biaya Pengiriman</label>
                                            <input type="text" name="sales_shipping_cost" id="sales_shipping_cost" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['sales_shipping_cost'], 0, ',', '.')}}"  disabled readonly>
                                            @error('sales_shipping_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sales_discount" class="form-label">Diskon Penjualan</label>
                                            <input type="text" name="sales_discount" id="sales_discount" class="form-control" placeholder="Rp" value="Rp. {{ number_format($hpp['sales_discount'], 0, ',', '.')}}"  disabled readonly>
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