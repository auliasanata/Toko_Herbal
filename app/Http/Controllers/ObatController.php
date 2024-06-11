<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('obat.index', compact('obats'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'bahan' => 'required',
            'kategori' => 'required',

            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);
        // dd($request);

        // Tangani unggah gambar
        if ($request->hasFile('image')) {
            $imageData = file_get_contents($request->image->getRealPath());
            $imageName = time() . '.' . $request->image->extension();
        } else {
            $imageData = null;
            $imageName = null;
        }

        Obat::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'bahan' => $request->bahan,
            'kategori' => $request->kategori,

            'stock' => $request->stock,
            'image' => $imageData, // Simpan BOB dari gambar
        ]);
        

        return redirect()->route('obat.index')
            ->with('success', 'Obat berhasil ditambahkan.');
    }

    public function show(Obat $obat)
    {
        return view('obat.show', compact('obat'));
    }

    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'bahan' => 'required',
            'kategori' => 'required',

            'stock' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);
    
        // Tangani pembaruan gambar
        if ($request->hasFile('image')) {
            $imageData = file_get_contents($request->image->getRealPath());
            $imageName = time() . '.' . $request->image->extension();
            $obat->image = $imageData;
        }
    
        $obat->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'bahan' => $request->bahan,
            'kategori' => $request->kategori,

            'stock' => $request->stock,
            'image' => $imageData ?? $obat->image, // Jika tidak ada pembaruan gambar
        ]);
    
        return redirect()->route('obat.index')
            ->with('success', 'Obat berhasil diperbarui.');
    }
    
    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obat.index')
            ->with('success', 'Obat berhasil dihapus.');
    }
}
