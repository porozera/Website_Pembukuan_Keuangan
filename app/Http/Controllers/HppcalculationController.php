<?php

namespace App\Http\Controllers;

use App\Models\Hppcalculation;
use Illuminate\Http\Request;

class HppcalculationController extends Controller
{
    public function index(Request $request)
    {
        $query = Hppcalculation::query();

        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }
    
        $hpp = $query->paginate(4);

        return view('pages.hpp.index', compact('hpp'));
    }

    public function add(){
        return view('pages.hpp.add');
    }

    public function create(Request $request){
        $attributes = $request->validate([
            'initial_stock'=> 'required',
            'final_stock'=> 'required',
            'purchase_amount'=> 'required',
            'shipping_cost'=> 'required',
            'purchase_return'=> 'required',
            'purchase_discount'=> 'required',
            'sales_revenue'=> 'required',
            'sales_return'=> 'required',
            'sales_discount'=> 'required',
            'sales_shipping_cost'=> 'required',
        ]);
        $data = Hppcalculation::create([
            "initial_stock" => $attributes['initial_stock'],
            "final_stock" => $attributes['final_stock'],
            "purchase_amount" => $attributes['purchase_amount'],
            "shipping_cost" => $attributes['shipping_cost'],
            "purchase_return" => $attributes['purchase_return'],
            "purchase_discount" => $attributes['purchase_discount'],
            "sales_revenue" => $attributes['sales_revenue'],
            "sales_return" => $attributes['sales_return'],
            "sales_discount" => $attributes['sales_discount'],
            "sales_shipping_cost" => $attributes['sales_shipping_cost'],
            "product_id"=> auth()->id(),
            "user_id"=> auth()->id(),
        ]);
        return redirect("/hpp")->with('success', 'Hpp created successfully!');;
    }

    public function edit($id)
    {
        $hpp = Hppcalculation::find($id);
        if (!$hpp) {
            return redirect('/edit_hpp')->with('error', 'Hpp not found');
        }
    
        return view('pages.hpp.edit', compact('hpp'));
    }

    public function update($id, Request $request){
        $attributes = $request -> validate([
           'initial_stock'=> 'required',
            'final_stock'=> 'required',
            'purchase_amount'=> 'required',
            'shipping_cost'=> 'required',
            'purchase_return'=> 'required',
            'purchase_discount'=> 'required',
            'sales_revenue'=> 'required',
            'sales_return'=> 'required',
            'sales_discount'=> 'required',
            'sales_shipping_cost'=> 'required', 
        ]);
        $data = Hppcalculation::findorfail($id);
        $data -> update([
            "initial_stock" => $attributes['initial_stock'],
            "final_stock" => $attributes['final_stock'],
            "purchase_amount" => $attributes['purchase_amount'],
            "shipping_cost" => $attributes['shipping_cost'],
            "purchase_return" => $attributes['purchase_return'],
            "purchase_discount" => $attributes['purchase_discount'],
            "sales_revenue" => $attributes['sales_revenue'],
            "sales_return" => $attributes['sales_return'],
            "sales_discount" => $attributes['sales_discount'],
            "sales_shipping_cost" => $attributes['sales_shipping_cost'],
            "product_id"=> auth()->id(),
            "user_id"=> auth()->id(),
        ]);
        return redirect('/hpp')->with('success', 'Hpp updated successfully!');
    }

    public function delete($id){
        Hppcalculation::where('id',$id) -> delete();
        return redirect('/hpp')->with('success', 'Hpp deleted successfully!');
    }

}
