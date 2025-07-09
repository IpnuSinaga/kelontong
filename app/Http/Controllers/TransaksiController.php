<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pelanggan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('pelanggan')->latest()->get();
    $pelanggans = Pelanggan::all();
    $barangs = Barang::all(); 

    return view('transaksi.index', compact('transaksis', 'pelanggans','barangs'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $barangs = Barang::all();
        return view('transaksi.create', compact('pelanggans', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal' => 'required|date',
            'barang_id.*' => 'required|exists:barangs,id',
            'jumlah.*' => 'required|integer|min:1',
            'harga.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($request->jumlah as $index => $jumlah) {
                $subtotal = $jumlah * $request->harga[$index];
                $total += $subtotal;
            }

            $transaksi = Transaksi::create([
                'pelanggan_id' => $request->pelanggan_id,
                'tanggal' => $request->tanggal,
                'total' => $total,
            ]);

            foreach ($request->barang_id as $index => $barang_id) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang_id,
                    'jumlah' => $request->jumlah[$index],
                    'harga' => $request->harga[$index],
                    'subtotal' => $request->jumlah[$index] * $request->harga[$index],
                ]);

                // Kurangi stok barang
                $barang = Barang::find($barang_id);
                $barang->stok -= $request->jumlah[$index];
                $barang->save();
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'details.barang']);
        return view('transaksi.show', compact('transaksi'));
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    // metode edit dan update bisa ditambahkan jika dibutuhkan
}
