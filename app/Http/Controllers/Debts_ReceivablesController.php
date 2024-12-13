<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Debts_Receivables;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class Debts_ReceivablesController extends Controller
{
    public function index(Request $request)
    {
        $query = Debts_Receivables::query();
    
        // Sorting
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->input('sort'), $request->input('direction'));
        }

        
        $sortDirection = request('direction', 'desc'); 
        $debt_receivable = $query->orderBy('created_at', $sortDirection)->paginate(10);
    
        return view('pages.debt_receivable.index', compact('debt_receivable'));
    }

    public function delete($id){
        Debts_Receivables::where('id',$id) -> delete();
        return redirect('/debt_receivable')->with('success', 'Data deleted successfully!');
    }

    public function edit($id)
    {
        $debt_receivable = Debts_Receivables::find($id);
        if (!$debt_receivable) {
            return redirect('/debt_receivable')->with('error', 'Data not found');
        }
    
        $payment = Payment::where('debts_receivables_id', $id)->get();
        $account = Account::where('category', 'Kas & Bank')->get();
    
        return view('pages.debt_receivable.edit', compact('debt_receivable', 'payment','account'));
    }

    public function payment(Request $request)
    {
        $attributes = $request->validate([
            'date' => 'required',
            'paid_amount' => 'required',
            'account' => 'required',
            'description' => 'required',
            'debts_receivables_id' => 'required|exists:debts_receivables,id',
        ]);
        $code = now()->format('Ymd') . rand(1000, 9999);
        $payment = Payment::create([
            "date" => $attributes['date'],
            "paid_amount" => $attributes['paid_amount'],
            "account" => $attributes['account'],
            "description" => $attributes['description'],
            "code" => $code,
            "debts_receivables_id" => $attributes['debts_receivables_id']
        ]);


        $debts = Debts_Receivables::findOrFail($attributes['debts_receivables_id']);
        
        $debts->paid_amount += $attributes['paid_amount']; // Penambahan jumlah dibayar
        $debts->rest_amount = $debts->amount - $debts->paid_amount; // Menghitung sisa yang harus dibayar
    
        if ($debts->rest_amount == 0) {
            $debts->status = 'Lunas';
        } else {
            $debts->status = 'Belum Lunas';
        }
        $debts->save();

        if ($debts->type == 'Hutang'){
            $transaction = Transaction::create([
                "date" => $attributes['date'],
                "transaction_type" => 'Pembayaran Hutang',
                "debit" => 'Hutang Usaha (2-20100)',
                "credit" => $attributes['account'],
                "amount" => $attributes['paid_amount'],
                "description" => $attributes['description'],
                "user_id" => auth()->id(),
    
                "contact" => $request->input('contact', null),
                "tax" => $request->input('tax', null),
                "due_date" => $request->input('due_date', null),
                "interest_rate" => $request->input('interest_rate', null),
            ]);
        } elseif ($debts->type == 'Piutang'){
            $transaction = Transaction::create([
                "date" => $attributes['date'],
                "transaction_type" => 'Pembayaran Piutang',
                "debit" => $attributes['account'],
                "credit" => 'Piutang Usaha (1-10100)',
                "amount" => $attributes['paid_amount'],
                "description" => $attributes['description'],
                "user_id" => auth()->id(),
    
                "contact" => $request->input('contact', null),
                "tax" => $request->input('tax', null),
                "due_date" => $request->input('due_date', null),
                "interest_rate" => $request->input('interest_rate', null),
            ]);
        }
        return redirect()->route('debt_receivable.edit', $attributes['debts_receivables_id'])->with('success', 'Payment created successfully!');
    }
    
}
