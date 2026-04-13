<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan ini ada (nanti kita buat Modelnya)

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT KOTA
        $jkt = DB::table('cities')->insertGetId([
            'name' => 'Jakarta Selatan', 'slug' => 'jakarta-selatan'
        ]);
        $bdg = DB::table('cities')->insertGetId([
            'name' => 'Bandung', 'slug' => 'bandung'
        ]);
        $ach = DB::table('cities')->insertGetId([
            'name' => 'Aceh', 'slug' => 'aceh'
        ]);

        // 2. BUAT KATEGORI
        $catFoto = DB::table('categories')->insertGetId([
            'name' => 'Photography', 'slug' => 'photography', 'icon' => 'fa-camera'
        ]);
        $catMakan = DB::table('categories')->insertGetId([
            'name' => 'Catering', 'slug' => 'catering', 'icon' => 'fa-utensils'
        ]);
        $catGedung = DB::table('categories')->insertGetId([
            'name' => 'Venue', 'slug' => 'venue', 'icon' => 'fa-building'
        ]);

        // 3. BUAT USER (LOGIN)
        // Admin
        DB::table('users')->insert([
            'name' => 'Admin Sistem',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Vendor 1 (Si Murah)
        $userV1 = DB::table('users')->insertGetId([
            'name' => 'Budi Foto',
            'email' => 'vendor1@test.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
        ]);

        // Vendor 2 (Si Sultan)
        $userV2 = DB::table('users')->insertGetId([
            'name' => 'Sultan Image',
            'email' => 'vendor2@test.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
        ]);

        // User Biasa (Pencari)
        $userClient = DB::table('users')->insertGetId([
            'name' => 'Ani Pengantin',
            'email' => 'ani@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 4. BUAT PROFIL VENDOR (DATA UNTUK SAW)

        // Vendor 1: Murah meriah
        $v1 = DB::table('vendors')->insertGetId([
            'user_id' => $userV1,
            'category_id' => $catFoto,
            'city_id' => $jkt,
            'nama_bisnis' => 'Budi Photography Murah',
            'slug' => 'budi-photo',
            'alamat_lengkap' => 'Jl. Tebet Raya No 1',
            'deskripsi_singkat' => 'Foto murah meriah hasil oke.',
            'tentang_kami' => 'Kami melayani foto wedding budget pelajar.',
            'no_whatsapp' => '62812345678',
            'is_verified' => false,
        ]);

        // Vendor 2: Mahal Eksklusif
        $v2 = DB::table('vendors')->insertGetId([
            'user_id' => $userV2,
            'category_id' => $catFoto,
            'city_id' => $jkt,
            'nama_bisnis' => 'Sultan Luxury Wedding',
            'slug' => 'sultan-luxury',
            'alamat_lengkap' => 'Jl. Pondok Indah No 99',
            'deskripsi_singkat' => 'Abadikan momen mewah anda.',
            'tentang_kami' => 'Spesialis wedding artis dan pejabat.',
            'no_whatsapp' => '62899999999',
            'is_verified' => true,
        ]);

        // 5. BUAT PAKET HARGA (KRITERIA COST)
        // Vendor 1 punya paket 1 Juta
        DB::table('pricelists')->insert([
            'vendor_id' => $v1,
            'nama_paket' => 'Paket Hemat',
            'harga' => 1000000, // 1 Juta
            'fitur_paket' => '1 Fotographer, 4 Jam, File Only'
        ]);

        // Vendor 2 punya paket 20 Juta
        DB::table('pricelists')->insert([
            'vendor_id' => $v2,
            'nama_paket' => 'Paket Sultan Gold',
            'harga' => 20000000, // 20 Juta
            'fitur_paket' => '3 Fotographer, Drone, Album Kulit, All Day'
        ]);

        // 6. BUAT REVIEW (KRITERIA BENEFIT)
        // Vendor 1 dapet rating 3 (Biasa aja)
        DB::table('reviews')->insert([
            'vendor_id' => $v1,
            'user_id' => $userClient,
            'rating' => 3,
            'komentar' => 'Lumayan lah buat harga segini.'
        ]);

        // Vendor 2 dapet rating 5 (Sempurna)
        DB::table('reviews')->insert([
            'vendor_id' => $v2,
            'user_id' => $userClient,
            'rating' => 5,
            'komentar' => 'Gila keren banget hasilnya! Worth it.'
        ]);
    }
}
