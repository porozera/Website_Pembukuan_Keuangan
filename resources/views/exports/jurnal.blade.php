<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Transaksi</th>
            <th>Kode Debit</th>
            <th>Akun Debit</th>
            <th>Debit</th>
            <th>Kode Kredit</th>
            <th>Akun Kredit</th>
            <th>Kredit</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jurnal as $item)
            <tr>
                <td>{{ $item->date }}</td>
                <td>{{ $item->transaction_type }}</td>
                <td>{{ $item->debit_code }}</td>
                <td>{{ $item->debit_account }}</td>
                <td>Rp. {{ number_format($item->amount, 0, ',', '.') }}</td>
                <td>{{ $item->credit_code }}</td>
                <td>{{ $item->credit_account }}</td>
                <td>Rp. {{ number_format($item->amount, 0, ',', '.') }}</td>
                <td>{{ $item->description }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4"><strong>Total</strong></td>
            <td><strong>Rp. {{ number_format($totalDebit, 0, ',', '.') }}</strong></td>
            <td></td>
            <td></td>
            <td><strong>Rp. {{ number_format($totalKredit, 0, ',', '.') }}</strong></td>
            <td></td>
        </tr>
    </tbody>
</table>
