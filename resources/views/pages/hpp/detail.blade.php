@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Perhitungan HPP'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Perhitungan HPP</h6>
                    </div>
                    <div class="card-body">
                        <form action="/hpp/calculate" method="POST">
                            @csrf
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
                                    <label for="shipping_cost" class="form-label">Shipping Cost/label>
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

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="sales_return" class="form-label">Sales Return</label>
                                    <input type="number" name="sales_return" id="sales_return" class="form-control" placeholder="Sales Return">
                                </div>
                                <div class="col-mb-6">
                                    <label for="sales_revenue" class="form-label">Sales Revenue</label>
                                    <input type="number" name="sales_revenue" id="sales_revenue" class="form-control" placeholder="Sales Revenue">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label for="sales_shipping_cost" class="form-label">Sales Shipping Cost</label>
                                    <input type="number" name="sales_shipping_cost" id="sales_shipping_cost" class="form-control" placeholder="Sales Shipping Cost">
                                </div>
                                <div class="col-mb-6">
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
                            
                            <div class="mb-3 row">
                                <div class="col-mb-6">
                                    <label for="hpp" class="form-label">HPP</label>
                                    <input type="number" name="hpp" id="hpp" class="form-control" placeholder="HPP">
                                </div>
                                <div class="col-mb-6">
                                    <label for="gross_profit" class="form-label">Gross Profit</label>
                                    <input type="number" name="gross_profit" id="gross_profit" class="form-control" placeholder="Gross Profit">
                                </div>
                                <div class="col-mb-6">
                                    <label for="recommended_price" class="form-label">Recommended Price</label>
                                    <input type="number" name="recommended_price" id="recommended_price" class="form-control" placeholder="Recommended Price">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Hitung</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
