<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\pesanan; // Import model Pemesanan

class PengirimanController extends Controller
{
    public function index()
    {
        $pengirimans = pesanan::all();
        return view('pengiriman.index', compact('pengirimans'));
    }

    public function create()
    {
        $pemesanans = Pemesanan::all(); // Ambil semua data pemesanan
        return view('pengiriman.create', compact('pemesanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'pemesanan_id' => 'required|exists:pemesanans,id',
            // Tambahkan validasi untuk kolom lainnya sesuai kebutuhan
        ]);

        Pengiriman::create($request->all());

        return redirect()->route('pengiriman.index')
            ->with('success', 'Data pengiriman berhasil ditambahkan.');
    }

    public function show(pesanan $pengiriman)
    {
        return view('pengiriman.show', compact('pengiriman'));
    }

    public function edit($id)
    {
        $pengiriman = pesanan::findOrFail($id);
        return view('pengiriman.edit', compact('pengiriman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'nama_produk' => 'required',
            'opsi_pengiriman' => 'required',
            'alamat_lengkap' => 'required',
            'provinsi' => 'required',
            'jumlah_produk' => 'required|numeric',
            'subtotal_pengiriman' => 'required',
            // Sesuaikan validasi dengan kebutuhan Anda
        ]);

        $pengiriman = pesanan::findOrFail($id);
        $pengiriman->nama_pengguna = $request->nama_pengguna;
        $pengiriman->nama_produk = $request->nama_produk;
        $pengiriman->opsi_pengiriman = $request->opsi_pengiriman;
        $pengiriman->alamat_lengkap = $request->alamat_lengkap;
        $pengiriman->provinsi = $request->provinsi;
        $pengiriman->jumlah_produk = $request->jumlah_produk;
        $pengiriman->subtotal_pengiriman = $request->subtotal_pengiriman;
        // Sesuaikan dengan atribut lain yang ingin diupdate

        $pengiriman->save();

        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil diperbarui.');
    }

    public function destroy(pesanan $pengiriman)
    {
        $pengiriman->delete();

        return redirect()->route('pengiriman.index')
            ->with('success', 'Data pengiriman berhasil dihapus.');
    }
}
