<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorAddress;

class VendorProfileController extends Controller
{
    public function edit()
    {
        $vendor = auth()->user()->vendor;
        // Daftar Kecamatan Banda Aceh sesuai revisi
        $kecamatans = [
            'Baiturrahman', 'Banda Raya', 'Jaya Baru', 'Kuta Alam',
            'Kuta Raja', 'Lueng Bata', 'Meuraxa', 'Syiah Kuala', 'Ulee Kareng'
        ];

        return view('vendor.profile', compact('vendor', 'kecamatans'));
    }

    public function update(Request $request)
    {
        $vendor = auth()->user()->vendor;

        // Validasi Inputan
        $request->validate([
            'nama_bisnis' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string|max:255',
            'tentang_kami' => 'required|string',
            'no_whatsapp' => 'required|string',
            'instagram' => 'nullable|string',
            'tiktok' => 'nullable|string',
            'jalan' => 'required|string',
            'desa' => 'required|string',
            'kecamatan' => 'required|string',
        ]);

        // 1. Update Data Utama Vendor & Medsos
        $vendor->update([
            'nama_bisnis' => $request->nama_bisnis,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'tentang_kami' => $request->tentang_kami,
            'no_whatsapp' => $request->no_whatsapp,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
        ]);

        // 2. Update atau Buat Data Alamat Baru di tabel vendor_addresses
        $vendor->address()->updateOrCreate(
            ['vendor_id' => $vendor->id],
            [
                'jalan' => $request->jalan,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
            ]
        );

        return back()->with('success', 'Profil Bisnis dan Alamat berhasil diperbarui!');
    }
}
