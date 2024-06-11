<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function tampilan()
    {
        return view('Dashboard.Dashboard');
    }

    public function datadiri()
    {
        $users = User::all();
        return view('pembeli.datadiri', compact('users'));
    }


    public function editdatadiri($id)
    {
        $user = Auth::user();
        return view('pembeli.editdatadiri', compact('user'));
    }

    public function updatedatadiri(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'no_hp' => 'required|string|max:15',
            'level' => 'required|string|max:50',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->level = $request->level;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('produk')->with('success', 'Data berhasil diperbarui');
    }

    public function tampilan1()
    {
        return view('Dashboard.Dashboard');
    }
    public function landingpage()
    {
        // Dapatkan id pengguna yang sedang login
        $userId = Auth::id();

        // Hitung jumlah pesanan dengan status keranjang untuk pengguna yang sedang login
        $jumlahPesananKeranjang = Pesanan::where('user_id', $userId)->where('status', 'keranjang')->count();

        // Ambil semua pesanan
        $pesanans = Pesanan::all();

        // Kirim variabel ke view menggunakan compact
        return view('landingpage', compact('pesanans', 'jumlahPesananKeranjang'));
    }


    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],

        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'no_hp' => $request['no_hp'],
            'alamat' => $request['alamat'],
            'level' => $request['level'],

        ]);

        return redirect('/Datauser')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'no_hp' => $request['no_hp'],
            'alamat' => $request['alamat'],
        ]);

        return redirect('/Datauser')->with('success', 'User update successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/Datauser')->with('success', 'User delate successfully.');
    }
}
