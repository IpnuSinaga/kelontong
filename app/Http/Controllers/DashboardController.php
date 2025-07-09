<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalBarang = Barang::count();
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::sum('total');

        return view('dashboard.index', compact(
            'totalPelanggan',
            'totalBarang',
            'totalTransaksi',
            'totalPendapatan'
        ));
    }
}
