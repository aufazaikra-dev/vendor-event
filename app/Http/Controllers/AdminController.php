<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. Dashboard Admin
    public function index()
    {
        $total_users = User::where('role', 'user')->count();
        $total_vendors = User::where('role', 'vendor')->count();
        $total_categories = Category::count();

        return view('admin.dashboard', compact('total_users', 'total_vendors', 'total_categories'));
    }

    // 2. Daftar Vendor & Cek Kelengkapan Profil
    public function vendors()
    {
        $vendors = Vendor::with(['user', 'address'])->latest()->get();
        return view('admin.vendors', compact('vendors'));
    }

    // Eksekusi Verifikasi
    public function verify(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['is_verified' => true]);
        return back()->with('success', 'Vendor berhasil diverifikasi dan kini tampil di Halaman Utama!');
    }

    // Eksekusi Batal Verifikasi
    public function unverify(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update(['is_verified' => false]);
        return back()->with('success', 'Verifikasi vendor berhasil dibatalkan. Vendor ini tidak akan tampil lagi di Halaman Utama.');
    }

    // 3. Data Pelanggan (User) & Riwayat Transaksi
    public function users()
    {
        // Ambil user biasa beserta transaksi dan vendor yang pernah dipakai
        $users = User::with(['transactions.vendor'])->where('role', 'user')->latest()->get();
        return view('admin.users', compact('users'));
    }
}
