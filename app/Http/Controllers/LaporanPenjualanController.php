<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfflineTransaction;
use App\Models\Pesanan;
use App\Models\User;


use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
{
    // Ambil data pesanan dengan filter berdasarkan tanggal, nama obat, dan jenis penjualan
    $pesanan = Pesanan::query()
        ->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])
        ->when($request->filled('nama_obat'), function ($query) use ($request) {
            $query->where('nama_produk', 'like', '%' . $request->nama_obat . '%');
        })
        ->get();

    // Ambil data transaksi offline dengan filter berdasarkan tanggal, nama obat, dan jenis penjualan
    $transactions = OfflineTransaction::with('obat')
        ->whereHas('obat', function ($query) use ($request) {
            $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])
                ->when($request->filled('nama_obat'), function ($query) use ($request) {
                    $query->where('nama', 'like', '%' . $request->nama_obat . '%');
                });
        })
        ->get();

    // Inisialisasi array untuk menyimpan data laporan penjualan
    $laporanPenjualan = [];

    // Loop melalui setiap pesanan
    foreach ($pesanan as $pemesanan) {
        // Tentukan jenis penjualan berdasarkan awalan nomor transaksi
        $jenisPenjualan = substr($pemesanan->no_transaksi, 0, 2) === 'ON' ? 'Online' : 'Offline';

        // Tambahkan data pesanan ke array laporan penjualan
        $laporanPenjualan[] = [
            'id_obat' => $pemesanan->obat_id,
            'nama_obat' => $pemesanan->nama_produk,
            'kuantitas' => $pemesanan->jumlah_produk,
            'harga_satuan' => $pemesanan->harga_produk,
            'harga_total' => $pemesanan->total_pembayaran,
            'no_transaksi' => $pemesanan->no_transaksi,
            'jenis_penjualan' => $jenisPenjualan,
        ];
    }

    // Loop melalui setiap transaksi offline
    foreach ($transactions as $transaction) {
        // Hitung harga total
        $hargaTotal = $transaction->sub_harga * $transaction->kuantitas;

        // Tambahkan data transaksi offline ke array laporan penjualan
        $laporanPenjualan[] = [
            'id_obat' => $transaction->obat->id,
            'nama_obat' => $transaction->obat->nama,
            'kuantitas' => $transaction->kuantitas,
            'harga_satuan' => $transaction->sub_harga,
            'harga_total' => $hargaTotal,
            'no_transaksi' => $transaction->no_transaksi,


            'jenis_penjualan' => 'Offline',
            
        ];
    }

    // Filter laporan penjualan berdasarkan jenis penjualan
    if ($request->filled('jenis_penjualan')) {
        $laporanPenjualan = array_filter($laporanPenjualan, function ($laporan) use ($request) {
            return $laporan['jenis_penjualan'] === $request->jenis_penjualan;
        });
    }

    return view('LaporanPenjualan.index', compact('laporanPenjualan'));
}



    public function exportPDF(Request $request)
    {
        $laporanPenjualan = $this->getLaporanPenjualan($request);

        // Load the HTML template for the PDF
        $html = view('pdf.laporan_penjualan', compact('laporanPenjualan'))->render();

        // Instantiate Dompdf
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (generate)
        $dompdf->render();

        // Output the generated PDF (force download)
        return $dompdf->stream('laporan_penjualan.pdf');
    }

    // Metode untuk mendapatkan data laporan penjualan
    private function getLaporanPenjualan($request)
    {
        // Ambil data pesanan dengan filter berdasarkan tanggal
        $pesanan = Pesanan::whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->get();

        // Ambil data transaksi offline dengan filter berdasarkan tanggal
        $transactions = OfflineTransaction::with('obat')
            ->whereHas('obat', function ($query) use ($request) {
                $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
            })
            ->get();

        // Inisialisasi array untuk menyimpan data laporan penjualan
        $laporanPenjualan = [];

        // Loop melalui setiap pesanan
        foreach ($pesanan as $pemesanan) {
            // Tambahkan data pesanan ke array laporan penjualan
            $laporanPenjualan[] = [
                'id_obat' => $pemesanan->obat_id,
                'nama_obat' => $pemesanan->nama_produk,
                'kuantitas' => $pemesanan->jumlah_produk,
                'harga_satuan' => $pemesanan->harga_produk,
                'harga_total' => $pemesanan->total_pembayaran,
                'jenis_penjualan' => 'Online',
            ];
        }

        // Loop melalui setiap transaksi offline
        foreach ($transactions as $transaction) {
            // Hitung harga total
            $hargaTotal = $transaction->sub_harga * $transaction->kuantitas;

            // Tambahkan data transaksi offline ke array laporan penjualan
            $laporanPenjualan[] = [
                'id_obat' => $transaction->obat->id,
                'nama_obat' => $transaction->obat->nama,
                'kuantitas' => $transaction->kuantitas,
                'harga_satuan' => $transaction->sub_harga,
                'harga_total' => $hargaTotal,
                'jenis_penjualan' => 'Offline',
            ];
        }

        return $laporanPenjualan;
    }



    public function user()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
}
