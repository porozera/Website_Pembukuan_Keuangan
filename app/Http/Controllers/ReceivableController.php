<?php

namespace App\Http\Controllers;

use App\Models\Receivable;
use Illuminate\Http\Request;

class ReceivableController extends Controller
{
    public function index(Request $request)
    {
        $query = Receivable::query();
    
        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }
    
        $sortDirection = request('direction', 'desc'); 
        $receivable = $query->orderBy('created_at', $sortDirection)->paginate(10);

        return view('pages.receivable.index', compact('receivable'));
    }

    public function add()
    {
        return view('pages.receivable.add');
    }

    public function create(Request $request)
    {
        $attributes = $request->validate([
            'amount' => 'required',
            'interest_rate' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:Paid,Unpaid', // Ensure status is valid
            'description' => 'required',
        ]);
    
        // Create the receivable record
        Receivable::create([
            'amount' => $attributes['amount'],
            'interest_rate' => $attributes['interest_rate'],
            'due_date' => $attributes['due_date'],
            'status' => $attributes['status'], // This should now be either 'Paid' or 'Unpaid'
            'description' => $attributes['description'],
            'user_id' => auth()->id(),
        ]);
    
        return redirect("/receivable")->with('success', 'Receivable created successfully!');
    }
    
    public function edit($id)
    {
        $receivable = Receivable::find($id);
        if (!$receivable) {
            return redirect('/receivable')->with('error', 'Receivable not found');
        }

        return view('pages.receivable.edit', compact('receivable'));
    }

    public function update($id, Request $request)
    {
        $attributes = $request->validate([
            'amount' => 'required',
            'interest_rate' => 'required',
            'due_date' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        $data = Receivable::findOrFail($id);
        $data->update([
            "amount" => $attributes['amount'],
            "interest_rate" => $attributes['interest_rate'],
            "due_date" => $attributes['due_date'],
            "status" => $attributes['status'],
            "description" => $attributes['description'],
            "user_id" => auth()->id(),
        ]);

        return redirect('/receivable')->with('success', 'Receivable updated successfully!');
    }

    public function delete($id)
    {
        Receivable::where('id', $id)->delete();
        return redirect('/receivable')->with('success', 'Receivable deleted successfully!');
    }
}
