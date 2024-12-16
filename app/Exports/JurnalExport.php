<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JurnalExport implements FromView
{
    private $startDate;
    private $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $jurnal = Transaction::whereBetween('date', [$this->startDate, $this->endDate])
            ->get();

        $totalDebit = $jurnal->sum('amount'); // Debit total
        $totalKredit = $jurnal->sum('amount'); // Kredit total

        return view('exports.jurnal', [
            'jurnal' => $jurnal,
            'totalDebit' => $totalDebit,
            'totalKredit' => $totalKredit,
        ]);
    }
}
