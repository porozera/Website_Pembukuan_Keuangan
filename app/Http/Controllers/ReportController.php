<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    
    
}   
