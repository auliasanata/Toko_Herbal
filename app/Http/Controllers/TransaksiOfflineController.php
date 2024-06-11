<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfflineTransaction;
use App\Models\Obat;



class TransaksiOfflineController extends Controller
{
    public function index()
    {
        $transactions = OfflineTransaction::with('obat')->get();
        return view('offline_transactions.index', compact('transactions'));
    }


    public function create()
    {
        $obats = Obat::all(); // Mengambil semua obat untuk dropdown
        return view('offline_transactions.create', compact('obats'));
    }

    public function store(Request $request)
    {
        // Validasi data dari $request
        $request->validate([
            'obat_id' => 'required|exists:obats,id',
            'kuantitas' => 'required|numeric',
            'sub_harga' => 'required|numeric',
            'total_bayar' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        // Dapatkan nomor transaksi terbaru dari database
        $latestTransaction = OfflineTransaction::whereNotNull('no_transaksi')->orderBy('no_transaksi', 'desc')->first();
        $latestTransactionNumber = $latestTransaction ? $latestTransaction->no_transaksi : 'OF0000'; // Jika tidak ada transaksi sebelumnya, gunakan nomor OF0000

        // Ambil angka dari nomor transaksi terbaru dan tambahkan 1
        $latestNumber = (int) substr($latestTransactionNumber, 2);
        $nextNumber = $latestNumber + 1;

        // Format nomor transaksi berikutnya agar sesuai dengan panjang string, misalnya menjadi OF0001, OF0002, dst.
        $transactionNumber = 'OF' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Buat transaksi offline baru dengan nomor transaksi
        OfflineTransaction::create([
            'obat_id' => $request->obat_id,
            'kuantitas' => $request->kuantitas,
            'sub_harga' => $request->sub_harga,
            'total_bayar' => $request->total_bayar,
            'tanggal' => $request->tanggal,
            'no_transaksi' => $transactionNumber, // Menambahkan nomor transaksi
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('offline_transactions.index')->with('success', 'Transaksi offline berhasil ditambahkan.');
    }


    public function show(OfflineTransaction $transaction)
    {
        // Tampilkan halaman detail transaksi offline
        return view('offline_transactions.show', compact('transaction'));
    }

    public function edit(OfflineTransaction $transaction)
    {
        $obats = Obat::all(); // Misalnya, Anda ingin mengambil semua obat untuk pilihan dropdown
        return view('offline_transactions.edit', compact('transaction', 'obats'));
    }


    public function update(Request $request, OfflineTransaction $transaction)
    {
        // Validasi data dari $request
        $request->validate([
            'obat_id' => 'required|exists:obats,id',
            'kuantitas' => 'required|numeric',
            'sub_harga' => 'required|numeric',
            'total_bayar' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        // Perbarui transaksi offline
        $transaction->update($request->all());

        // Redirect kembali dengan pesan sukses
        return redirect()->route('offline_transactions.index')->with('success', 'Transaksi offline berhasil diperbarui.');
    }

    public function destroy(OfflineTransaction $transaction)
    {
        // Hapus transaksi offline
        $transaction->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('offline_transactions.index')->with('success', 'Transaksi offline berhasil dihapus.');
    }
}
