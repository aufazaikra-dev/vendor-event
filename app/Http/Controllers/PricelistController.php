<?php

namespace App\Http\Controllers;

use App\Models\Pricelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PricelistController extends Controller
{
    // 1. TAMPILKAN DAFTAR PAKET (READ)
    public function index()
    {
        // Ambil ID Vendor dari User yang sedang login
        $vendorId = Auth::user()->vendor->id;

        // Ambil semua paket milik vendor tersebut
        $paket = Pricelist::where('vendor_id', $vendorId)->get();

        return view('vendor.paket.index', compact('paket'));
    }

    // 2. TAMPILKAN FORM TAMBAH (CREATE)
    public function create()
    {
        return view('vendor.paket.create');
    }

    // 3. SIMPAN DATA KE DATABASE (STORE)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_paket' => 'required',
            'harga' => 'required|numeric|min:0',
            'fitur_paket' => 'required',
        ]);

        // Simpan
        Pricelist::create([
            'vendor_id' => Auth::user()->vendor->id, // Otomatis link ke vendor yang login
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'fitur_paket' => $request->fitur_paket,
        ]);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    // 4. HAPUS DATA (DESTROY)
    public function destroy($id)
    {
        $paket = Pricelist::findOrFail($id);

        // Pastikan yang menghapus adalah pemiliknya (Security Check)
        if($paket->vendor_id != Auth::user()->vendor->id) {
            abort(403);
        }

        $paket->delete();
        return redirect()->back()->with('success', 'Paket dihapus.');
    }
}
