<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query();

        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }

        $transaction = $query->paginate(4);
        $account = Account::all();

        return view('pages.transaction.index', compact('transaction','account'));
    }

    public function add(){
        $account = Account::all();
        return view('pages.transaction.add',  compact('account'));
    }

    public function create(Request $request){
        $attributes = $request->validate([
            'date' => 'required',
            'transaction_type' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);
        $data = Transaction::create([
            "date" => $attributes['date'],
            "transaction_type" => $attributes['transaction_type'],
            "amount" => $attributes['amount'],
            "description" => $attributes['description'],
            "category" => $attributes['category'],
            "user_id" => auth()->id(),
        ]);
        return redirect("/transaction")->with('success', 'Transaction created successfully!');;
    }

    public function edit($id){
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return redirect('/edit_transaction')->with('error', 'Transaction not found');
        }

        return view('pages.transaction.edit', compact('transaction'));
    }

    public function update($id, Request $request) {
        $attributes = $request->validate([
            'date' => 'required',
            'transaction_type' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);
        $data = Transaction::findorfail ($id);
        $data -> update([
            "date" => $attributes['date'],
            "transaction_type" => $attributes['transaction_type'],
            "amount" => $attributes['amount'],
            "description" => $attributes['description'],
            "category" => $attributes['category'],
            "user_id" => auth()->id(),
        ]);
        return redirect("/transaction")->with('success', 'Transaction updated successfully!');;
    }

    public function delete($id){
        Transaction::where('id',$id) -> delete();
        return redirect('/transaction')->with('success', 'Transaction deleted successfully!');
    }
}
