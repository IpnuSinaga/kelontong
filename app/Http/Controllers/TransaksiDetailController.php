<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    public function index()
    {
        $details = TransaksiDetail::with(['transaksi', 'barang'])->get();
        return view('transaksi_detail.index', compact('details'));
    }

    public function create()
    {
        $transaksis = Transaksi::all();
        $barangs = Barang::all();
        return view('transaksi_detail.create', compact('transaksis', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        $subtotal = $request->jumlah * $request->harga;

        TransaksiDetail::create([
            'transaksi_id' => $request->transaksi_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'subtotal' => $subtotal,
        ]);

        return redirect()->route('transaksidetail.index')->with('success', 'Detail transaksi ditambahkan.');
    }

    public function edit(TransaksiDetail $transaksidetail)
    {
        $transaksis = Transaksi::all();
        $barangs = Barang::all();
        return view('transaksi_detail.edit', compact('transaksidetail', 'transaksis', 'barangs'));
    }

    public function update(Request $request, TransaksiDetail $transaksidetail)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        $subtotal = $request->jumlah * $request->harga;

        $transaksidetail->update([
            'transaksi_id' => $request->transaksi_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'subtotal' => $subtotal,
        ]);

        return redirect()->route('transaksidetail.index')->with('success', 'Detail transaksi diperbarui.');
    }

    public function destroy(TransaksiDetail $transaksidetail)
    {
        $transaksidetail->delete();
        return redirect()->route('transaksidetail.index')->with('success', 'Detail transaksi dihapus.');
    }
}
