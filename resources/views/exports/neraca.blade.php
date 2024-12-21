<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Akun</th>
            <th>Saldo Debit</th>
            <th>Saldo Kredit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($neraca as $item)
            <tr>
                <td>{{ $item['code'] }}</td>
                <td>{{ $item['account'] }}</td>
                <td>{{ $item['debit'] }}</td>
                <td>{{ $item['credit'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td><strong>Total</strong></td>
            <td><strong>{{ $totalDebit }}</strong></td>
            <td><strong>{{ $totalKredit }}</strong></td>
        </tr>
    </tbody>
</table>
