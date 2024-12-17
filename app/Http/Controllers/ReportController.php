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

    
    public function labarugi(Request $request)
{
    // Default tanggal
    $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
    $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

    // Query transaksi dalam rentang tanggal
    $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();

    // Mengelompokkan data berdasarkan angka depan kode
    $groupedData = collect([
        '4' => collect(),
        '5' => collect(),
        '6' => collect(),
        '7' => collect(),
        '8' => collect(),
    ]);

    foreach ($transactions as $transaction) {
        // Proses kode debit
        $debitGroup = substr($transaction->debit_code, 0, 1);
        if ($groupedData->has($debitGroup)) {
            $groupedData[$debitGroup]->push([
                'code' => $transaction->debit_code,
                'name' => $transaction->debitAccount->name ?? 'Tidak Diketahui',
                'amount' => $transaction->amount,
            ]);
        }

        // Proses kode kredit
        $creditGroup = substr($transaction->credit_code, 0, 1);
        if ($groupedData->has($creditGroup)) {
            $groupedData[$creditGroup]->push([
                'code' => $transaction->credit_code,
                'name' => $transaction->creditAccount->name ?? 'Tidak Diketahui',
                'amount' => $transaction->amount,
            ]);
        }
    }

    // Hitung total per grup dan transformasikan data
    $totals = $groupedData->map(function ($items) {
        return collect($items)
            ->groupBy('code')
            ->map(function ($entries, $code) {
                return [
                    'code' => $code,
                    'name' => $entries->first()['name'],
                    'total' => $entries->sum('amount'),
                ];
            });
    });

    // Total per kategori
    $totalPendapatan = $totals['4']->sum('total');
    $totalHargaPokokPenjualan = $totals['5']->sum('total');
    $totalBebanOperasional = $totals['6']->sum('total');
    $totalPendapatanLainnya = $totals['7']->sum('total');
    $totalBebanLainnya = $totals['8']->sum('total');
    $labaKotor = $totalPendapatan - $totalHargaPokokPenjualan;
    $labaBebanOperasional = $labaKotor - $totalBebanOperasional;
    $labaBersih = $labaBebanOperasional + $totalPendapatanLainnya - $totalBebanLainnya;

    // Kirim data ke view
    return view('pages.report.labaRugi', [
        'startDate' => $startDate,
        'endDate' => $endDate,
        'pendapatan' => $totals['4'], // Data dengan kode depan 4
        'hargaPokokPenjualan' => $totals['5'], // Data dengan kode depan 5
        'bebanOperasional' => $totals['6'], // Data dengan kode depan 6
        'pendapatanLainnya' => $totals['7'], // Data dengan kode depan 7
        'bebanLainnya' => $totals['8'], // Data dengan kode depan 8
        'totalPendapatan' => $totalPendapatan,
        'totalHargaPokokPenjualan' => $totalHargaPokokPenjualan,
        'totalBebanOperasional' => $totalBebanOperasional,
        'totalPendapatanLainnya' => $totalPendapatanLainnya,
        'totalBebanLainnya' => $totalBebanLainnya,
        'labaKotor' => $labaKotor,
        'labaBebanOperasional' => $labaBebanOperasional,
        'labaBersih' => $labaBersih
    ]);
}
}   
