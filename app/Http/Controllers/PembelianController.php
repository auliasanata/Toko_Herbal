<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class PembelianController extends Controller
{
    public function handleBuktiPembayaran(Request $request)
    {
        $userId = Auth::id();
        $userName = Auth::user()->name;

        // Ambil data yang dikirimkan dari formulir
        $nama_produk = $request->input('nama_produk');
        $deskripsi_produk = $request->input('deskripsi_produk');
        $harga_produk = $request->input('harga_produk');
        $alamat_lengkap = $request->input('alamat_lengkap');
        $jumlah_produk = $request->input('jumlah_produk');
        $provinsi = $request->input('provinsi');
        $opsi_pengiriman = $request->input('opsi_pengiriman');
        $subtotal_pengiriman = $request->input('subtotal_pengiriman');
        $subtotal_produk = $request->input('subtotal_produk');
        $total_pembayaran = $request->input('total_pembayaran');
        $image_produk = $request->input('image_produk');

        // Periksa tombol mana yang diklik oleh pengguna
        if ($request->has('keranjang')) {
            // Jika tombol "Keranjang" diklik, simpan data ke dalam tabel keranjang dengan status "keranjang"
            $status = 'keranjang';

            // Simpan data ke dalam tabel sesuai dengan status yang ditentukan
            $pesanan = new Pesanan();
            $pesanan->nama_produk = $nama_produk;
            $pesanan->deskripsi_produk = $deskripsi_produk;
            $pesanan->harga_produk = $harga_produk;
            $pesanan->alamat_lengkap = $alamat_lengkap;
            $pesanan->jumlah_produk = $jumlah_produk;
            $pesanan->provinsi = $provinsi;
            $pesanan->opsi_pengiriman = $opsi_pengiriman;
            $pesanan->subtotal_pengiriman = $subtotal_pengiriman;
            $pesanan->subtotal_produk = $subtotal_produk;
            $pesanan->total_pembayaran = $total_pembayaran;
            $pesanan->image_produk = $image_produk;
            $pesanan->status = $status;
            $pesanan->user_id = $userId;
            $pesanan->nama_pengguna = $userName; // Sesuaikan dengan nama kolom yang ada di dalam model Pesanan
            $pesanan->save();

            // Redirect user ke halaman produk atau halaman lainnya
            return redirect('/produk');
        } else {
            // Jika tombol "Buat Pesanan" diklik, lemparkan data ke tampilan "buktipembayaran" tanpa menyimpannya ke database lagi
            return view('pembeli.buktipembayaran')->with([
                'nama_produk' => $nama_produk,
                'deskripsi_produk' => $deskripsi_produk,
                'harga_produk' => $harga_produk,
                'alamat_lengkap' => $alamat_lengkap,
                'jumlah_produk' => $jumlah_produk,
                'provinsi' => $provinsi,
                'opsi_pengiriman' => $opsi_pengiriman,
                'subtotal_pengiriman' => $subtotal_pengiriman,
                'subtotal_produk' => $subtotal_produk,
                'total_pembayaran' => $total_pembayaran,
                'image_produk' => $image_produk,
            ]);
        }
    }




    public function home()
    {
        $pesanans = Pesanan::all();
        return view('pembeli.home', compact('pesanans'));
    }

    public function masterpembeli()
    {
        // Dapatkan id pengguna yang sedang login
        // $userId = Auth::id();

        // // Hitung jumlah pesanan dengan status keranjang untuk pengguna yang sedang login
        // $jumlahPesananKeranjang = Pesanan::where('user_id', $userId)->where('status', 'keranjang')->count();


        // // Kirim variabel ke view menggunakan compact
        // return view('pembeli.masterpembeli', compact('jumlahPesananKeranjang'));
        return view('pembeli.masterpembeli');
    }

    public function batalPesanan($no_transaksi)
    {
        $pesanan = Pesanan::where('no_transaksi', $no_transaksi)->get();

        if ($pesanan->isEmpty()) {
            return redirect()->route('pemesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        foreach ($pesanan as $p) {
            $p->delete();
        }

        return redirect()->route('pemesanan')->with('success', 'Pesanan berhasil dibatalkan.');
    }



    public function hapuspesanan($id)
    {
        try {
            // Temukan pesanan berdasarkan ID
            $pesanan = Pesanan::findOrFail($id);

            // Lakukan penghapusan pesanan
            $pesanan->delete();

            // Redirect kembali ke halaman sebelumnya atau tampilkan pesan sukses, tergantung pada kebutuhan Anda
            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi, misalnya jika pesanan tidak ditemukan
            return redirect()->back()->with('error', 'Gagal membatalkan pesanan. Silakan coba lagi.');
        }
    }


    public function produk()
    {
        $produk = Obat::all();
        return view('Pembeli.produk', compact('produk'));
    }



    public function pemesananpembeli()
    {
        // Mendapatkan data pengguna yang telah diautentikasi
        $user = Auth::user();

        // Mengembalikan tampilan 'pembeli.pemesanan' dan meneruskan data pengguna
        return view('pembeli.pemesanan', compact('user'));
    }


    public function bukti()
    {
        return view('pembeli.buktipembayaran');
    }


    public function buktipembayarankeranjang()
    {
        return view('pembeli.buktipembayarankeranjang');
    }

    public function pesanan()
    {
        // Dapatkan id pengguna yang sedang login
        $userId = Auth::id();
    
        // Ambil data pesanan berdasarkan user_id yang sesuai dengan id pengguna yang sedang login
        // dan hanya yang tidak memiliki status 'keranjang'
        $pesanans = Pesanan::where('user_id', $userId)
            ->where('status', '!=', 'keranjang')
            ->get();
    
            $transaksiCounts = Pesanan::select('no_transaksi', \DB::raw('count(*) as count'))
            ->where('user_id', $userId)
            ->where('status', '!=', 'keranjang')
            ->groupBy('no_transaksi')
            ->pluck('count', 'no_transaksi');
    
        return view('pembeli.pesanan', compact('pesanans', 'transaksiCounts'));
    }
    

    public function keranjang()
    {
        // Dapatkan id pengguna yang sedang login
        $userId = Auth::id();

        // Ambil data pesanan dengan status "keranjang" berdasarkan user_id yang sesuai dengan id pengguna yang sedang login
        $pesanan = Pesanan::where('user_id', $userId)
            ->where('status', 'keranjang')
            ->get();

        return view('pembeli.keranjang', compact('pesanan'));
    }


    public function reviewBuktiPembayaran(Request $request)
    {
        // Validasi request
        $request->validate([
            'selected_pesanan' => 'required',
            'metode_pembayaran' => 'required', // Tambahkan validasi untuk metode_pembayaran
        ]);

        // Dapatkan id pesanan yang dipilih dari input hidden
        $selectedPesananIds = json_decode($request->input('selected_pesanan'), true);

        // Dapatkan nomor transaksi terbaru dari database
        $latestTransaction = Pesanan::whereNotNull('no_transaksi')->orderBy('no_transaksi', 'desc')->first();
        $latestTransactionNumber = $latestTransaction ? $latestTransaction->no_transaksi : 'ON0000'; // Jika tidak ada transaksi sebelumnya, gunakan nomor ON0000

        // Ambil angka dari nomor transaksi terbaru dan tambahkan 1
        $latestNumber = (int) substr($latestTransactionNumber, 2);
        $nextNumber = $latestNumber + 1;

        // Format nomor transaksi berikutnya agar sesuai dengan panjang string, misalnya menjadi ON0001, ON0002, dst.
        $transactionNumber = 'ON' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Ambil data pesanan berdasarkan id yang dipilih
        $selectedPesanan = Pesanan::whereIn('id', $selectedPesananIds)->get();

        // Set default image path
        // $imagePath = public_path('assets/images/logo.jpeg');

        // Cek apakah ada bukti pembayaran diunggah
        if ($request->hasFile('bukti_pembayaran')) {
            // Jika ada, ambil data gambar dari request
            $imageData = file_get_contents($request->file('bukti_pembayaran')->getRealPath());
        } else {
            // Jika tidak ada, ambil gambar default
            // $imageData = file_get_contents($imagePath);
            $imageData = null; // Handle case when no image is uploaded and no default image is used
        }

        // Update pesanan dengan bukti pembayaran, nomor transaksi baru, metode pembayaran, dan status diproses
        foreach ($selectedPesanan as $pesanan) {
            $pesanan->bukti_pembayaran = $imageData;
            $pesanan->no_transaksi = $transactionNumber;
            $pesanan->metode_pembayaran = $request->input('metode_pembayaran'); // Set nilai metode_pembayaran dari input pengguna
            $pesanan->status = 'diproses'; // Set default status to 'diproses'

            $pesanan->save();
        }

        // Redirect ke view pembeli.pesanan dengan pesan sukses
        return redirect()->route('produk')->with('success', 'Bukti pembayaran berhasil diunggah.');
    }







    public function detailpesanan()
    {
        return view('pembeli.detailpesanan');
    }
}
