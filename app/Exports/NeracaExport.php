<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Transaction;
use Carbon\Carbon;

class NeracaExport implements FromView
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        // Ambil data transaksi sesuai tanggal
        $transactions = Transaction::whereBetween('date', [$this->startDate, $this->endDate])->get();

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
        })->sortBy('code');

        $totalDebit = $neraca->sum('debit');
        $totalKredit = $neraca->sum('credit');

        return view('exports.neraca', [
            'neraca' => $neraca,
            'totalDebit' => $totalDebit,
            'totalKredit' => $totalKredit,
        ]);
    }
}
