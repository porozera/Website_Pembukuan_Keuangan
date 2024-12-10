<?php

namespace App\Http\Controllers;

use App\Models\Hppcalculation;
use App\Models\Product;
use Illuminate\Http\Request;

class HppcalculationController extends Controller
{
    public function index(Request $request)
    {
        $query = Hppcalculation::with('product');

        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }

        $sortDirection = request('direction', 'desc'); 
        $hpp = $query->orderBy('created_at', $sortDirection)->paginate(4);

        return view('pages.hpp.index', compact('hpp'));
    }

    public function add(){
        $product = Product::all();
        return view('pages.hpp.add', compact('product'));
    }

    public function create(Request $request)
    {
        // Validasi input
        $attributes = $request->validate([
            'initial_stock' => 'required|numeric',
            'final_stock' => 'required|numeric',
            'production_cost' => 'required|numeric',
            'quantity_produced' => 'required|numeric',
            'sales_return' => 'required|numeric',
            'sales_discount' => 'required|numeric',
            'sales_shipping_cost' => 'required|numeric',
            'price_per_unit' => 'required|numeric', // Harga jual
            'product_id' => 'required|exists:products,id',
        ]);

        // Hitung Harga Produksi per Unit
        $price_per_unit = $attributes['production_cost'] / $attributes['quantity_produced'];

        // Hitung Quantity Sold
        $quantity_sold = $attributes['initial_stock'] - $attributes['final_stock'];

        // Hitung Sales Revenue
        $sales_revenue = $quantity_sold * $attributes['price_per_unit'];

        // Hitung HPP
        $hpp = ($attributes['initial_stock'] * $price_per_unit) - $attributes['final_stock'];

        // Hitung Gross Profit
        $gross_profit = $sales_revenue 
            - $hpp 
            - $attributes['sales_return'] 
            - $attributes['sales_discount'] 
            - $attributes['sales_shipping_cost'];

        // Hitung Recommended Price (margin 20%)
        $recommended_price = $hpp > 0 ? $hpp * 1.2 : 0;

    
        $data = Hppcalculation::create([
            "initial_stock" => $attributes['initial_stock'],
            "final_stock" => $attributes['final_stock'],
            "production_cost" => $attributes['production_cost'],
            "quantity_produced" => $attributes['quantity_produced'],
            "price_per_unit" => $price_per_unit,
            "sales_revenue" => $sales_revenue,
            "sales_return" => $attributes['sales_return'],
            "sales_discount" => $attributes['sales_discount'],
            "sales_shipping_cost" => $attributes['sales_shipping_cost'],
            "hpp" => $hpp,
            "gross_profit" => $gross_profit,
            "recommended_price" => $recommended_price,
            "product_id" => $attributes['product_id'],
            "user_id" => auth()->id(),
        ]);
    
        // Redirect dengan pesan sukses
        return redirect("/hpp")->with('success', 'HPP created successfully!');
    }
    
    

    public function detail($id)
    {
        $hpp = Hppcalculation::with('product')->find($id);
        if (!$hpp) {
            return redirect('/edit_hpp')->with('error', 'Hpp not found');
        }
    
        return view('pages.hpp.detail', compact('hpp'));
    }

    public function edit($id)
    {
        $hpp = Hppcalculation::with('product')->find($id);
        if (!$hpp) {
            return redirect('/edit_hpp')->with('error', 'Hpp not found');
        }
        $allproduct = Product::all();
    
        return view('pages.hpp.edit', compact('hpp','allproduct'));
    }

    public function update($id, Request $request)
    {
    // Validasi input
    $attributes = $request->validate([
        'initial_stock' => 'required|numeric',
        'final_stock' => 'required|numeric',
        'production_cost' => 'required|numeric',
        'quantity_produced' => 'required|numeric',
        'sales_return' => 'required|numeric',
        'sales_discount' => 'required|numeric',
        'sales_shipping_cost' => 'required|numeric',
        'price_per_unit' => 'required|numeric', // Harga jual
        'product_id' => 'required|exists:products,id',
    ]);

    try {
        // Ambil data berdasarkan ID
        $data = Hppcalculation::findOrFail($id);

        // Hitung Harga Produksi per Unit
        $price_per_unit = $attributes['production_cost'] / $attributes['quantity_produced'];

        // Hitung Quantity Sold
        $quantity_sold = $attributes['initial_stock'] - $attributes['final_stock'];

        // Hitung Sales Revenue
        $sales_revenue = $quantity_sold * $attributes['price_per_unit'];

        // Hitung HPP
        $hpp = ($attributes['initial_stock'] * $price_per_unit) - $attributes['final_stock'];

        // Hitung Gross Profit
        $gross_profit = $sales_revenue 
            - $hpp 
            - $attributes['sales_return'] 
            - $attributes['sales_discount'] 
            - $attributes['sales_shipping_cost'];

        // Hitung Recommended Price (margin 20%)
        $recommended_price = $hpp > 0 ? $hpp * 1.2 : 0;

        // Update data
        $data->update([
            "initial_stock" => $attributes['initial_stock'],
            "final_stock" => $attributes['final_stock'],
            "production_cost" => $attributes['production_cost'],
            "quantity_produced" => $attributes['quantity_produced'],
            "price_per_unit" => $price_per_unit,
            "sales_revenue" => $sales_revenue,
            "sales_return" => $attributes['sales_return'],
            "sales_discount" => $attributes['sales_discount'],
            "sales_shipping_cost" => $attributes['sales_shipping_cost'],
            "hpp" => $hpp,
            "gross_profit" => $gross_profit,
            "recommended_price" => $recommended_price,
            "product_id" => $attributes['product_id'],
            "user_id" => auth()->id(),
        ]);

        return redirect('/hpp')->with('success', 'HPP updated successfully!');
    } catch (\Exception $e) {
        return redirect('/hpp')->with('error', 'Failed to update HPP: ' . $e->getMessage());
    }
}
    
    public function delete($id){
        Hppcalculation::where('id',$id) -> delete();
        return redirect('/hpp')->with('success', 'Hpp deleted successfully!');
    }

}
