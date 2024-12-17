<table>
    <thead>
        <tr>
            <th colspan="3">Laporan Laba Rugi</th>
        </tr>
        <tr>
            <th colspan="3">Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</th>
        </tr>
        <tr>
            <th>Kode</th>
            <th>Nama Akun</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3"><strong>Pendapatan</strong></td>
        </tr>
        @foreach ($pendapatan as $item)
        <tr>
            <td>{{ $item['code'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ number_format($item['total'], 2) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total Pendapatan</strong></td>
            <td>{{ number_format($totalPendapatan, 2) }}</td>
        </tr>

        <tr>
            <td colspan="3"><strong>Harga Pokok Penjualan</strong></td>
        </tr>
        @foreach ($hargaPokokPenjualan as $item)
        <tr>
            <td>{{ $item['code'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ number_format($item['total'], 2) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total Harga Pokok Penjualan</strong></td>
            <td>{{ number_format($totalHargaPokokPenjualan, 2) }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Laba Kotor</strong></td>
            <td>{{ number_format($labaKotor, 2) }}</td>
        </tr>

        <tr>
            <td colspan="3"><strong>Beban Operasional</strong></td>
        </tr>
        @foreach ($bebanOperasional as $item)
        <tr>
            <td>{{ $item['code'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ number_format($item['total'], 2) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total Beban Operasional</strong></td>
            <td>{{ number_format($totalBebanOperasional, 2) }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Laba Beban Operasional</strong></td>
            <td>{{ number_format($labaBebanOperasional, 2) }}</td>
        </tr>

        <tr>
            <td colspan="3"><strong>Pendapatan Lainnya</strong></td>
        </tr>
        @foreach ($pendapatanLainnya as $item)
        <tr>
            <td>{{ $item['code'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ number_format($item['total'], 2) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total Pendapatan Lainnya</strong></td>
            <td>{{ number_format($totalPendapatanLainnya, 2) }}</td>
        </tr>

        <tr>
            <td colspan="3"><strong>Beban Lainnya</strong></td>
        </tr>
        @foreach ($bebanLainnya as $item)
        <tr>
            <td>{{ $item['code'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ number_format($item['total'], 2) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total Beban Lainnya</strong></td>
            <td>{{ number_format($totalBebanLainnya, 2) }}</td>
        </tr>
        <!-- Tambahkan kelompok lain seperti Harga Pokok Penjualan, Beban Operasional, dll. -->
        <tr>
            <td colspan="2"><strong>Laba Bersih</strong></td>
            <td>{{ number_format($labaBersih, 2) }}</td>
        </tr>
    </tbody>
</table>
