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
            'raw_material_cost' => 'required|numeric',
            'labor_cost' => 'required|numeric',
            'overhead_cost' => 'required|numeric',
            'packaging_cost' => 'nullable|numeric',
            'other_production_costs' => 'nullable|numeric',
            'quantity_produced' => 'required|numeric',
            'sales_return' => 'nullable|numeric',
            'sales_discount' => 'nullable|numeric',
            'sales_shipping_cost' => 'nullable|numeric',// Harga jual
            'product_id' => 'required|exists:products,id',
        ]);

        // Hitung Total Biaya Produksi
        $total_production_cost = 
            $attributes['raw_material_cost'] + 
            $attributes['labor_cost'] + 
            $attributes['overhead_cost'] +
            ($attributes['packaging_cost'] ?? 0) +
            ($attributes['other_production_costs'] ?? 0);

        // Hitung Harga Produksi per Unit
        $price_per_unit = $total_production_cost / $attributes['quantity_produced'];

        // Hitung Quantity Sold
        $quantity_sold = $attributes['initial_stock'] - $attributes['final_stock'];

        // Hitung Pendapatan Penjualan
        $sales_revenue = $quantity_sold * $price_per_unit;

        // Hitung HPP
        $hpp = $quantity_sold * $price_per_unit;

        // Hitung Laba Kotor
        $gross_profit = $sales_revenue
            - $hpp
            - ($attributes['sales_return'] ?? 0)
            - ($attributes['sales_discount'] ?? 0)
            - ($attributes['sales_shipping_cost'] ?? 0);

        // Hitung Harga Rekomendasi (margin 20%)
        $recommended_price = $hpp > 0 ? $hpp / $quantity_sold * 1.2 : 0;

        // Simpan data ke database
        $data = Hppcalculation::create([
            "initial_stock" => $attributes['initial_stock'],
            "final_stock" => $attributes['final_stock'],
            "raw_material_cost" => $attributes['raw_material_cost'],
            "labor_cost" => $attributes['labor_cost'],
            "overhead_cost" => $attributes['overhead_cost'],
            "packaging_cost" => $attributes['packaging_cost'] ?? 0,
            "other_production_costs" => $attributes['other_production_costs'] ?? 0,
            "quantity_produced" => $attributes['quantity_produced'],
            "total_production_cost" => $total_production_cost,
            "price_per_unit" => $price_per_unit,
            "sales_revenue" => $sales_revenue,
            "sales_return" => $attributes['sales_return'] ?? 0,
            "sales_discount" => $attributes['sales_discount'] ?? 0,
            "sales_shipping_cost" => $attributes['sales_shipping_cost'] ?? 0,
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
        $product = Product::all();
    
        return view('pages.hpp.edit', compact('hpp','product'));
    }

    public function update(Request $request, $id)
    {
        // Temukan data berdasarkan ID
        $hppCalculation = Hppcalculation::findOrFail($id);
    
        // Validasi input
        $attributes = $request->validate([
            'initial_stock' => 'required|numeric',
            'final_stock' => 'required|numeric',
            'raw_material_cost' => 'required|numeric',
            'labor_cost' => 'required|numeric',
            'overhead_cost' => 'required|numeric',
            'packaging_cost' => 'nullable|numeric',
            'other_production_costs' => 'nullable|numeric',
            'quantity_produced' => 'required|numeric',
            'sales_return' => 'nullable|numeric',
            'sales_discount' => 'nullable|numeric',
            'sales_shipping_cost' => 'nullable|numeric',
            'product_id' => 'required|exists:products,id',
        ]);
    
        // Hitung Total Biaya Produksi
        $total_production_cost = 
            $attributes['raw_material_cost'] + 
            $attributes['labor_cost'] + 
            $attributes['overhead_cost'] +
            ($attributes['packaging_cost'] ?? 0) +
            ($attributes['other_production_costs'] ?? 0);
    
        // Hitung Harga Produksi per Unit
        $price_per_unit = $total_production_cost / $attributes['quantity_produced'];
    
        // Hitung Quantity Sold
        $quantity_sold = $attributes['initial_stock'] - $attributes['final_stock'];
    
        // Hitung Pendapatan Penjualan
        $sales_revenue = $quantity_sold * $price_per_unit;
    
        // Hitung HPP
        $hpp = $quantity_sold * $price_per_unit;
    
        // Hitung Laba Kotor
        $gross_profit = $sales_revenue
            - $hpp
            - ($attributes['sales_return'] ?? 0)
            - ($attributes['sales_discount'] ?? 0)
            - ($attributes['sales_shipping_cost'] ?? 0);
    
        // Hitung Harga Rekomendasi (margin 20%)
        $recommended_price = $hpp > 0 ? $hpp / $quantity_sold * 1.2 : 0;
    
        // Perbarui data ke database
        $hppCalculation->update([
            "initial_stock" => $attributes['initial_stock'],
            "final_stock" => $attributes['final_stock'],
            "raw_material_cost" => $attributes['raw_material_cost'],
            "labor_cost" => $attributes['labor_cost'],
            "overhead_cost" => $attributes['overhead_cost'],
            "packaging_cost" => $attributes['packaging_cost'] ?? 0,
            "other_production_costs" => $attributes['other_production_costs'] ?? 0,
            "quantity_produced" => $attributes['quantity_produced'],
            "total_production_cost" => $total_production_cost,
            "price_per_unit" => $price_per_unit,
            "sales_revenue" => $sales_revenue,
            "sales_return" => $attributes['sales_return'] ?? 0,
            "sales_discount" => $attributes['sales_discount'] ?? 0,
            "sales_shipping_cost" => $attributes['sales_shipping_cost'] ?? 0,
            "hpp" => $hpp,
            "gross_profit" => $gross_profit,
            "recommended_price" => $recommended_price,
            "product_id" => $attributes['product_id'],
            "user_id" => auth()->id(),
        ]);
    
        // Redirect dengan pesan sukses
        return redirect("/hpp")->with('success', 'HPP updated successfully!');
    }
    
    public function delete($id){
        Hppcalculation::where('id',$id) -> delete();
        return redirect('/hpp')->with('success', 'Hpp deleted successfully!');
    }

}
