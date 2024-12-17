<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use App\Models\Transaction;

class LabaRugiExport implements FromView
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate ? Carbon::parse($startDate) : now()->startOfMonth();
        $this->endDate = $endDate ? Carbon::parse($endDate) : now();
    }

    public function view(): View
    {
        $transactions = Transaction::whereBetween('date', [$this->startDate, $this->endDate])->get();

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

        return view('exports.labarugi', [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
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
            'labaBersih' => $labaBersih,
        ]);
    }
}
