@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit HPP'])
        <div class="container">
            <div class="row mb-5">
                <div class="col">
                    <div class="card card-hover">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="/hpp/edit/{{$hpp->id}}/perform/" enctype="multipart/form-data" id="hppEditForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 row">
                                        <h7><b>Edit HPP</b></h7>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <label for="product_id">Nama Produk</label>
                                            <select class="form-control" id="product_id" name="product_id" required>
                                                <option value="{{$hpp->product->id}}">{{$hpp->product->name}}</option>
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
                                        <h7><b>Biaya Produksi</b></h7>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="raw_material_cost" class="form-label">Biaya Bahan Baku</label>
                                            <input type="number" name="raw_material_cost" id="raw_material_cost" class="form-control" placeholder="Rp" value="{{$hpp->raw_material_cost}}">
                                            @error('raw_material_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="labor_cost" class="form-label">Biaya Tenaga Kerja</label>
                                            <input type="number" name="labor_cost" id="labor_cost" class="form-control" placeholder="Rp" value="{{$hpp->labor_cost}}">
                                            @error('labor_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="overhead_cost" class="form-label">Biaya Operasional</label>
                                            <input type="number" name="overhead_cost" id="overhead_cost" class="form-control" placeholder="Rp" value="{{$hpp->overhead_cost}}">
                                            @error('overhead_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="packaging_cost" class="form-label">Biaya Pengemasan</label>
                                            <input type="number" name="packaging_cost" id="packaging_cost" class="form-control" placeholder="Rp" value="{{$hpp->packaging_cost}}">
                                            @error('packaging_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="other_production_costs" class="form-label">Biaya Produksi Lainnya</label>
                                            <input type="number" name="other_production_costs" id="other_production_costs" class="form-control" placeholder="Rp" value="{{$hpp->other_production_costs}}">
                                            @error('other_production_costs') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="quantity_produced" class="form-label">Jumlah Barang Diproduksi</label>
                                            <input type="number" name="quantity_produced" id="quantity_produced" class="form-control" placeholder="Qty" value="{{$hpp->quantity_produced}}">
                                            @error('quantity_produced') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <h7><b>Stok Produk</b></h7>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="initial_stock" class="form-label">Stok Awal</label>
                                            <input type="number" name="initial_stock" id="initial_stock" class="form-control" placeholder="Qty" value="{{$hpp->initial_stock}}">
                                            @error('initial_stock') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="final_stock" class="form-label">Stok Akhir</label>
                                            <input type="number" name="final_stock" id="final_stock" class="form-control" placeholder="Qty" value="{{$hpp->final_stock}}">
                                            @error('final_stock') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <h7><b>Penjualan</b></h7>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="sales_shipping_cost" class="form-label">Biaya Pengiriman</label>
                                            <input type="number" name="sales_shipping_cost" id="sales_shipping_cost" class="form-control" placeholder="Rp" value="{{$hpp->sales_shipping_cost}}">
                                            @error('sales_shipping_cost') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sales_return" class="form-label">Retur Penjualan</label>
                                            <input type="number" name="sales_return" id="sales_return" class="form-control" placeholder="Rp" value="{{$hpp->sales_return}}">
                                            @error('sales_return') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
        
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="sales_discount" class="form-label">Diskon Penjualan</label>
                                            <input type="number" name="sales_discount" id="sales_discount" class="form-control" placeholder="Rp" value="{{$hpp->sales_discount}}">
                                            @error('sales_discount') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>

                                    </div>  
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group text-end">
                                                <button type="button" class="btn btn-primary btn-sm w-20 btn-hover" data-bs-toggle="modal" data-bs-target="#addModal">
                                                    Edit
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
                Are you sure to update this data?
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
                document.getElementById('hppEditForm').submit();
            });
        </script>
@endsection