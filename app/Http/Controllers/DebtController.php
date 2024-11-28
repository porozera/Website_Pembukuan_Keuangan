<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        $query = Debt::query();
    
        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }
    
        $debt = $query->paginate(4);
    
        return view('pages.debt.index', compact('debt'));
    }
    
    

    public function add(){
        return view('pages.debt.add');
    }

    public function create(Request $request){
        $attributes = $request->validate([
            'amount' => 'required',
            'interest_rate' => 'required',
            'due_date' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);
        $data = Debt::create([
            "amount" => $attributes['amount'],
            "interest_rate" => $attributes['interest_rate'],
            "due_date" => $attributes['due_date'],
            "status" => $attributes['status'],
            "description" => $attributes['description'],
            "user_id" => auth()->id(),
        ]);
        return redirect("/debt")->with('success', 'Debt created successfully!');;
    }

    public function edit($id)
    {
        // Fetch the debt record by its ID and pass it to the view
        $debt = Debt::find($id);
    
        // Check if the debt exists
        if (!$debt) {
            return redirect('/edit_debt')->with('error', 'Debt not found');
        }
    
        return view('pages.debt.edit', compact('debt'));
    }

    public function update($id, Request $request){
        $attributes = $request -> validate([
            'amount' => 'required',
            'interest_rate' => 'required',
            'due_date' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);
        $data = Debt::findorfail($id);
        $data -> update([
            "amount" => $attributes['amount'],
            "interest_rate" => $attributes['interest_rate'],
            "due_date" => $attributes['due_date'],
            "status" => $attributes['status'],
            "description" => $attributes['description'],
            "user_id" => auth()->id(),
        ]);
        return redirect('/debt')->with('success', 'Debt updated successfully!');
    }

    public function delete($id){
        Debt::where('id',$id) -> delete();
        return redirect('/debt')->with('success', 'Debt deleted successfully!');
    }
}
