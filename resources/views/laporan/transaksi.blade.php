@extends('layout.app')

@section('content')
<div class="container">
    <h2>Laporan Transaksi</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th>Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                @foreach($transaksi->details as $index => $detail)
                <tr>
                    @if($index == 0)
                        <td rowspan="{{ $transaksi->details->count() }}">{{ $transaksi->tanggal->format('d-m-Y') }}</td>
                        <td rowspan="{{ $transaksi->details->count() }}">{{ $transaksi->pelanggan->nama }}</td>
                    @endif
                    <td>{{ $detail->barang->nama }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    @if($index == 0)
                        <td rowspan="{{ $transaksi->details->count() }}">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    @endif
                </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total Keseluruhan</th>
                <th>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
