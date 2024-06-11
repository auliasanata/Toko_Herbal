<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::all();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create()
    {
        $obat = Obat::all(); // Ambil semua data obat
        return view('pemesanan.create', compact('obat'));
    }


    public function pemesanan($id)
    {
        // Mengambil data produk berdasarkan ID
        $produk = Obat::findOrFail($id);
    
        // Kemudian, lemparkan data produk ke view untuk ditampilkan
        return view('pembeli.pemesanan', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'id_customer' => 'required',
            'id_obat' => 'required',
            'kualitas' => 'required|numeric',
            'alamat' => 'required',
            'provinsi' => 'required',
            'pengirim' => 'required',
            'opsi_bayar' => 'required',
            'sub_harga' => 'required|numeric',
            'sub_kirim' => 'required|numeric',
            'total_bayar' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $data = $request->all();
        $data['status'] = 'offline'; // Menambahkan nilai default "offline" untuk status

        Pemesanan::create($data);

        return redirect()->route('pemesanan.index')
            ->with('success', 'Data pemesanan berhasil ditambahkan.');
    }

    public function show(Pemesanan $pemesanan)
    {
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function edit(Pemesanan $pemesanan)
    {
        return view('pemesanan.edit', compact('pemesanan'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'id_customer' => 'required',
            'id_obat' => 'required',
            'kualitas' => 'required|numeric',
            'alamat' => 'required',
            'provinsi' => 'required',
            'pengirim' => 'required',
            'opsi_bayar' => 'required',
            'sub_harga' => 'required|numeric',
            'sub_kirim' => 'required|numeric',
            'total_bayar' => 'required|numeric',
            'tanggal' => 'required|date',

        ]);

        $pemesanan->update($request->all());

        return redirect()->route('pemesanan.index')
            ->with('success', 'Data pemesanan berhasil diperbarui.');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')
            ->with('success', 'Data pemesanan berhasil dihapus.');
    }

  public function konfirmasi(Pemesanan $pemesanan)
{
    // Temukan semua pesanan dengan nomor transaksi yang sama
    $pesananSama = Pemesanan::where('no_transaksi', $pemesanan->no_transaksi)->get();

    // Lakukan iterasi dan perbarui status pesanan
    foreach ($pesananSama as $pesanan) {
        $pesanan->status_pemesanan = 'Konfirmasi'; // atau 'Confirmed', sesuai preferensi
        $pesanan->save();
    }

    return redirect()->route('pemesanan.index')
        ->with('success', 'Pesanan berhasil dikonfirmasi.');
}


    public function checkbox(Request $request)
    {
        $selectedIds = $request->input('selected_ids');

        // Ubah string menjadi array jika perlu
        if (is_string($selectedIds)) {
            $selectedIds = explode(',', $selectedIds);
        }

        // Lakukan tindakan batch di sini
        if ($request->has('delete')) {
            // Hapus pemesanan yang dipilih
            Pemesanan::whereIn('id', $selectedIds)->delete();
            return redirect()->back()->with('success', 'Data pemesanan berhasil dihapus.');
        } elseif ($request->has('konfirmasi')) {
            // Ubah status_pemesanan menjadi 'Konfirmasi' untuk pemesanan yang dipilih
            Pemesanan::whereIn('id', $selectedIds)->update(['status_pemesanan' => 'Konfirmasi']);
            return redirect()->back()->with('success', 'Status pemesanan berhasil diubah menjadi "Konfirmasi".');
        }
    }
}
