<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Debts_Receivables;
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
            'debit' => 'required',
            'credit' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);

        $bunga = $attributes['amount'] * ( $request->input('interest_rate', 0) / 100);
        $pajak = $attributes['amount']* ($request->input('tax', 0) / 100);
        $total = $attributes['amount'] + $bunga + $pajak;

        $transaction = Transaction::create([
            "date" => $attributes['date'],
            "transaction_type" => $attributes['transaction_type'],
            "debit" => $attributes['debit'],
            "credit" => $attributes['credit'],
            "amount" => $total,
            "description" => $attributes['description'],
            "user_id" => auth()->id(),

            "contact" => $request->input('contact', null),
            "tax" => $request->input('tax', null),
            "due_date" => $request->input('due_date', null),
            "interest_rate" => $request->input('interest_rate', null),
        ]);

        if($attributes['transaction_type'] == 'Hutang' or $attributes['transaction_type'] == 'Pengeluaran Sebagai Hutang' ){
            $invoice = now()->format('Ymd') . rand(1000, 9999);
            $debts = Debts_Receivables::create([
                'invoice' => $invoice,
                'type' => 'Hutang',
                'amount' => $total,
                'paid_amount' => 0,
                'rest_amount' => $total,
                "interest_rate" => $request->input('interest_rate', null),
                "date" => $attributes['date'],
                "due_date" => $request->input('due_date', $attributes['date']),
                "status" => 'Pending',
                "description" => $attributes['description'],
                "user_id" => auth()->id(),
                "transaction_id"  => $transaction->id,
            ]);
        } elseif ($attributes['transaction_type'] == 'Piutang' or $attributes['transaction_type'] == 'Pemasukan Sebagai Piutang'){
            $invoice = now()->format('Ymd') . rand(10, 99);
            $debts = Debts_Receivables::create([
                'invoice' => $invoice,
                'type' => 'Piutang',
                'amount' => $total,
                'paid_amount' => 0,
                'rest_amount' => $total,
                "interest_rate" => $request->input('interest_rate', null),
                "date" => $attributes['date'],
                "due_date" => $request->input('due_date', $attributes['date']),
                "status" => 'Pending',
                "description" => $attributes['description'],
                "user_id" => auth()->id(),
                "transaction_id"  => $transaction->id,
            ]);
        }
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
