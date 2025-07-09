<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 6px; text-align: left; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $i => $transaksi)
                @foreach($transaksi->details as $j => $detail)
                    <tr>
                        @if($j == 0)
                            <td rowspan="{{ count($transaksi->details) }}">{{ $i + 1 }}</td>
                            <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->tanggal->format('d-m-Y') }}</td>
                            <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->pelanggan->nama }}</td>
                        @endif
                        <td>{{ $detail->barang->nama }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        @if($j == 0)
                            <td rowspan="{{ count($transaksi->details) }}">
                                Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
