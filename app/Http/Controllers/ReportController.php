<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NeracaExport;

class ReportController extends Controller
{
    public function index(){
        $transaction = Transaction::all();
        return view('pages.report.index');
    }

    

    public function jurnal(Request $request)
    {
        // Konversi tanggal input menjadi instance Carbon atau gunakan default
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date')) 
            : now()->startOfMonth();
    
        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date')) 
            : now()->endOfMonth();
    
        // Query data jurnal dengan filter tanggal
        $jurnal = Transaction::whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('date', 'asc')
            ->get();
    
        // Hitung total debit dan kredit
        $totalDebit = $jurnal->sum('amount');
        $totalKredit = $jurnal->sum('amount');
    
        // Passing data ke view
        return view('pages.report.jurnal', compact('jurnal', 'startDate', 'endDate', 'totalDebit', 'totalKredit'));
    }


    public function neraca(Request $request)
    {
        // Ambil tanggal dari request atau gunakan default tanggal awal dan akhir
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date')) 
            : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date')) 
            : Carbon::now()->endOfMonth();
    
        // Ambil data transaksi dalam rentang tanggal
        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();
    
        // Gabungkan debit_code dan credit_code
        $mergedData = collect();
    
        foreach ($transactions as $transaction) {
            if ($transaction->debit_code) {
                $mergedData->push([
                    'code' => $transaction->debit_code,
                    'account' => $transaction->debit_account,
                    'debit' => $transaction->amount,
                    'credit' => 0,
                ]);
            }
    
            if ($transaction->credit_code) {
                $mergedData->push([
                    'code' => $transaction->credit_code,
                    'account' => $transaction->credit_account,
                    'debit' => 0,
                    'credit' => $transaction->amount,
                ]);
            }
        }
    
        // Kelompokkan berdasarkan kode akun dan hitung saldo
        $neraca = $mergedData->groupBy('code')->map(function ($items) {
            $account = $items->first()['account'];
            $debit = $items->sum('debit');
            $credit = $items->sum('credit');
    
            return [
                'code' => $items->first()['code'],
                'account' => $account,
                'debit' => $debit > $credit ? $debit - $credit : 0,
                'credit' => $credit > $debit ? $credit - $debit : 0,
            ];
        });
    
        // Sort berdasarkan kode dari kecil ke besar
        $neraca = $neraca->sortBy('code');
    
        $totalDebit = $neraca->sum('debit');
        $totalKredit = $neraca->sum('credit');
    
        return view('pages.report.neraca', compact('neraca', 'totalDebit', 'totalKredit', 'startDate', 'endDate'));
    }

    public function exportNeraca(Request $request)
    {
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date')) 
            : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date')) 
            : Carbon::now()->endOfMonth();

        return Excel::download(new NeracaExport($startDate, $endDate), 'neraca-' . now()->format('Y-m-d') . '.xlsx');
    }
    
}   
