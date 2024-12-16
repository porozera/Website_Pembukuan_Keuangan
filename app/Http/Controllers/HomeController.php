<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Debts_Receivables;
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

        // Hutang
        $debts = Debts_Receivables::where('type', 'Hutang')->get();

        // Inisialisasi data untuk grafik hutang
        $debtData = [];
        $grandDebtsTotal = 0; // Inisialisasi total hutang
    
        // Proses setiap data hutang
        foreach ($debts as $debt) {
            $date = Carbon::parse($debt->date)->format('d F'); // Format tanggal
    
            // Menambahkan jumlah hutang per tanggal
            if (!isset($debtData[$date])) {
                $debtData[$date] = 0;
            }
            $debtData[$date] += $debt->rest_amount; // Menambahkan sisa hutang
    
            // Menambahkan total hutang ke grand total
            $grandDebtsTotal += $debt->rest_amount; // Mengakumulasi total hutang
        }

        // Menyiapkan data untuk grafik
        $debtLabels = array_keys($debtData);
        $debtTotals = array_values($debtData);
        

        // Piutang
        $receivables = Debts_Receivables::where('type', 'Piutang')->get();

        // Inisialisasi data untuk grafik piutang
        $receivableData = [];
        $grandReceivablesTotal = 0; // Inisialisasi total piutang
    
        // Proses setiap data piutang
        foreach ($receivables as $receivable) {
            $date = Carbon::parse($receivable->date)->format('d F'); // Format tanggal
    
            // Menambahkan jumlah piutang per tanggal
            if (!isset($receivableData[$date])) {
                $receivableData[$date] = 0;
            }
            $receivableData[$date] += $receivable->rest_amount; // Menambahkan sisa piutang
    
            // Menambahkan total piutang ke grand total
            $grandReceivablesTotal += $receivable->rest_amount; // Mengakumulasi total piutang
        }// Total = Nilai hutang per tanggal

         // Menyiapkan data untuk grafik piutang
        $receivableLabels = array_keys($receivableData);
        $receivableTotals = array_values($receivableData);

        return view('pages.dashboard', compact('labels', 'totals', 'grandTotal','debtLabels', 'debtTotals', 'grandDebtsTotal','receivableLabels', 'receivableTotals', 'grandReceivablesTotal'));
    }
}
