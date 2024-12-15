<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = Transaction::select('transaction_type', 'amount', 'date')->get();

        $totalData = [];
        $grandTotal = 0;
    
        foreach ($transactions as $transaction) {
            $date = Carbon::parse($transaction->date)->format('d F');
    
            if (!isset($totalData[$date])) {
                $totalData[$date] = 0;
            }
    
            switch ($transaction->transaction_type) {
                case 'Pemasukan':
                case 'Hutang':
                case 'Pembayaran Piutang':
                case 'Pemasukan Sebagai Piutang':
                    $totalData[$date] += $transaction->amount;
                    $grandTotal += $transaction->amount; 
                    break;
    
                case 'Pengeluaran':
                case 'Piutang':
                case 'Pembayaran Hutang':
                case 'Pengeluaran Sebagai Hutang':
                    $totalData[$date] -= $transaction->amount;
                    $grandTotal -= $transaction->amount;
                    break;
    
                default:
                    break;
            }
        }
    
        $labels = array_keys($totalData); 
        $totals = array_values($totalData);
    
        return view('pages.dashboard', compact('labels', 'totals', 'grandTotal'));
    }
}
