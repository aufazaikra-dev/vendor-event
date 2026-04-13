<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VendorAuthController extends Controller
{
    // Tampilkan Form Daftar Vendor
    public function showRegisterForm()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('auth.register_vendor', compact('categories', 'cities'));
    }

    // Proses Pendaftaran
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nama_bisnis' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        // 2. Buat Akun User (Role: Vendor)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
        ]);

        // 3. Buat Profil Vendor Dasar (Otomatis)
        Vendor::create([
            'user_id' => $user->id,
            'category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'nama_bisnis' => $request->nama_bisnis,
            'slug' => Str::slug($request->nama_bisnis) . '-' . time(),
            'alamat_lengkap' => '-',
            'deskripsi_singkat' => 'Vendor baru di platform kami.',
            'tentang_kami' => '-',
            'no_whatsapp' => '-',
            'is_verified' => false, // Harus disetujui Admin dulu
        ]);

        // 4. Login Otomatis & Lempar ke Dashboard
        Auth::login($user);
        return redirect()->route('vendor.dashboard')->with('success', 'Selamat datang! Silakan lengkapi profil bisnis Anda.');
    }
}
