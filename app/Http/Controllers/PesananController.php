<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{


    public function index()
    {
        // Ambil semua data pesanan dengan bukti pembayaran dari database
        $pesanan = Pesanan::whereNot('status', 'keranjang')->get();

        // Kirim data pesanan ke view untuk ditampilkan
        return view('pemesanan.index', compact('pesanan'));
    }
    

    public function konfirmasi($no_transaksi)
    {
        // Lakukan proses konfirmasi pesanan berdasarkan nomor transaksi
        Pesanan::where('no_transaksi', $no_transaksi)->update(['status' => 'Konfirmasi']);

        return redirect()->route('pemesanan.index')
            ->with('success', 'Pesanan berhasil dikonfirmasi.');
    }



    public function diterima($no_transaksi)
    {
        // Temukan semua pesanan dengan nomor transaksi yang sama
        $pesanan = Pesanan::where('no_transaksi', $no_transaksi)->get();

        if ($pesanan->isEmpty()) {
            return redirect()->route('pemesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        // Update status pesanan menjadi "Diterima" untuk setiap pesanan
        foreach ($pesanan as $p) {
            $p->update(['status' => 'Diterima']);
        }

        return redirect()->route('pemesanan')->with('success', 'Pesanan berhasil ditandai sebagai "Diterima".');
    }

    public function detail($no_transaksi)
    {
        $pesanan = Pesanan::where('no_transaksi', $no_transaksi)->get();
        // Lakukan logika untuk menampilkan detail pesanan
        return view('pembeli.detail_pesanan', ['pesanan' => $pesanan]);
    }



    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('pemesanan.edit', compact('pesanan'));
    }
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Update data pesanan
        $pesanan->nama_produk = $request->nama_produk;
        $pesanan->harga_produk = $request->harga_produk;
        $pesanan->jumlah_produk = $request->jumlah_produk;
        $pesanan->subtotal_pengiriman = $request->subtotal_pengiriman;
        $pesanan->subtotal_produk = $request->subtotal_produk;
        $pesanan->total_pembayaran = $request->total_pembayaran;
        $pesanan->created_at = $request->created_at;

        $pesanan->save();

        return redirect()->route('pemesanan.index')->with('success', 'Data pemesanan berhasil diperbarui.');
    }


    public function destroy($no_transaksi)
    {
        // Hapus semua data pemesanan dengan nomor transaksi yang sama
        Pesanan::where('no_transaksi', $no_transaksi)->delete();

        return redirect()->route('pemesanan.index')
            ->with('success', 'Data pemesanan dengan nomor transaksi ' . $no_transaksi . ' berhasil dihapus.');
    }

    public function show($no_transaksi)
    {
        $pesanan = Pesanan::where('no_transaksi', $no_transaksi)->get();
        return view('pemesanan.show', compact('pesanan'));
    }




    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir jika diperlukan
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'harga_produk' => 'required|numeric',
            'alamat_lengkap' => 'required|string|max:255',
            'jumlah_produk' => 'required|integer',
            'provinsi' => 'required|string|max:255',
            'opsi_pengiriman' => 'required|string|max:255',
            'subtotal_pengiriman' => 'required|numeric',
            'subtotal_produk' => 'required|numeric',
            'total_pembayaran' => 'required|numeric',
            'image_produk' => 'nullable|string', // Asumsikan bahwa image_produk adalah path atau URL
            'metode_pembayaran' => 'nullable|string', // Asumsikan bahwa image_produk adalah path atau URL

        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            // Jika ada, ambil data gambar dari request
            $imageData = file_get_contents($request->file('bukti_pembayaran')->getRealPath());
        } else {
            // Jika tidak ada, set image data to null
            $imageData = null;
        }

        // Dapatkan nomor transaksi terbaru dari database
        $latestTransaction = Pesanan::whereNotNull('no_transaksi')->orderBy('no_transaksi', 'desc')->first();
        $latestTransactionNumber = $latestTransaction ? $latestTransaction->no_transaksi : 'ON0000'; // Jika tidak ada transaksi sebelumnya, gunakan nomor ON0000

        // Ambil angka dari nomor transaksi terbaru dan tambahkan 1
        $latestNumber = (int) substr($latestTransactionNumber, 2);
        $nextNumber = $latestNumber + 1;

        // Format nomor transaksi berikutnya agar sesuai dengan panjang string, misalnya menjadi ON0001, ON0002, dst.
        $transactionNumber = 'ON' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $userId = Auth::id();
        $userName = Auth::user()->name;

        $pesanan = new Pesanan([
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk' => $request->harga_produk,
            'alamat_lengkap' => $request->alamat_lengkap,
            'jumlah_produk' => $request->jumlah_produk,
            'provinsi' => $request->provinsi,
            'opsi_pengiriman' => $request->opsi_pengiriman,
            'subtotal_pengiriman' => $request->subtotal_pengiriman,
            'subtotal_produk' => $request->subtotal_produk,
            'total_pembayaran' => $request->total_pembayaran,
            'image_produk' => $request->image_produk, // Memperbaiki variabel yang disebutkan
            'bukti_pembayaran' => $imageData,
            'user_id' => $userId,
            'nama_pengguna' => $userName, // Sesuaikan dengan nama kolom yang ada di dalam model Pesanan
            'metode_pembayaran' => $request->metode_pembayaran,
            'no_transaksi' => $transactionNumber, // Menambahkan nomor transaksi
            'status' => 'diproses' // Menambahkan status default

        ]);

        // dd($pesanan);
        $pesanan->save();

        return redirect()->route('pemesanan')
            ->with('success', 'Data pemesanan berhasil ditambahkan.');
    }
}
