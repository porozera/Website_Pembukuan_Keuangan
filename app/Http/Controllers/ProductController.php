<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
    
        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }
    
        $sortDirection = request('direction', 'desc'); 
        $product = $query->orderBy('created_at', $sortDirection)->paginate(5);

    
        return view('pages.product.index', compact('product'));
    }

    public function add(){
        return view('pages.product.add');
    }

    public function create(Request $request){
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $data = Product::create([
            "name" => $attributes['name'],
            "description" => $attributes['description'],
            "user_id" => auth()->id(),
        ]);
        return redirect("/product")->with('success', 'Product created successfully!');;
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect('/product')->with('error', 'Product not found');
        }
    
        return view('pages.product.edit', compact('product'));
    }

    public function update($id, Request $request){
        $attributes = $request -> validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $data = Product::findorfail($id);
        $data -> update([
            "name" => $attributes['name'],
            "description" => $attributes['description'],
            "user_id" => auth()->id(),
        ]);
        return redirect('/product')->with('success', 'Product updated successfully!');
    }

    public function delete($id){
        Product::where('id',$id) -> delete();
        return redirect('/product')->with('success', 'Product deleted successfully!');
    }
}
