<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use PDF;

class LaporanController extends Controller
{
    public function cetakTransaksi()
    {
        $transaksis = Transaksi::with('pelanggan', 'details.barang')->latest()->get();

        $pdf = PDF::loadView('laporan.transaksi_pdf', compact('transaksis'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-transaksi.pdf');
    }
}
