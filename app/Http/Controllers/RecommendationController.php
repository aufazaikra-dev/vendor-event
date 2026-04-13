<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        // Daftar Kecamatan khusus Banda Aceh (Sesuai Revisi)
        $kecamatans = [
            'Baiturrahman', 'Banda Raya', 'Jaya Baru', 'Kuta Alam',
            'Kuta Raja', 'Lueng Bata', 'Meuraxa', 'Syiah Kuala', 'Ulee Kareng'
        ];

        if (!$request->has('cari')) {
            return view('home', [
                'categories' => $categories,
                'kecamatans' => $kecamatans,
                'old_input' => []
            ]);
        }

        // ================= LOGIKA SAW FINAL =================

        $inputHarga = $request->input('bobot_harga', 50);
        $inputRating = $request->input('bobot_rating', 30);
        $inputPengalaman = $request->input('bobot_pengalaman', 20); // Diubah dari bobot_porto

        $totalBobot = $inputHarga + $inputRating + $inputPengalaman;
        $w1 = $inputHarga / $totalBobot;
        $w2 = $inputRating / $totalBobot;
        $w3 = $inputPengalaman / $totalBobot;

        // AMBIL DATA & FILTER
        $query = Vendor::with(['pricelists', 'reviews', 'transactions', 'address', 'category'])
                        ->where('is_verified', true);

        // 1. Filter Budget
        if ($request->filled('max_budget')) {
            $budget = $request->input('max_budget');
            $query->whereHas('pricelists', function ($q) use ($budget) {
                $q->where('harga', '<=', $budget);
            });
        }

        // 2. Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('category_id', $request->input('kategori'));
        }

        // 3. Filter Kecamatan (Banda Aceh)
        if ($request->filled('kecamatan')) {
            $kecamatan = $request->input('kecamatan');
            $query->whereHas('address', function ($q) use ($kecamatan) {
                $q->where('kecamatan', $kecamatan);
            });
        }

        $vendors = $query->get();

        if ($vendors->isEmpty()) {
            return view('home', [
                'error' => 'Maaf, tidak ada vendor yang cocok dengan filter pencarian Anda.',
                'old_input' => $request->all(),
                'categories' => $categories,
                'kecamatans' => $kecamatans
            ]);
        }

        // MENCARI NILAI MAX & MIN UNTUK NORMALISASI
        $minPrice = $vendors->map(fn($v) => $v->pricelists->min('harga') ?? 0)->filter()->min() ?: 1;
        // THE GAME CHANGER: Hitung Max Pengalaman berdasarkan TRANSAKSI, bukan Portofolio!
        $maxPengalaman = $vendors->map(fn($v) => $v->transactions->count())->max() ?: 1;
        $maxRating = 5;

        // RUMUS NORMALISASI DAN PERKALIAN BOBOT SAW
        $hasil = $vendors->map(function ($vendor) use ($minPrice, $maxPengalaman, $maxRating, $w1, $w2, $w3) {
            $harga = $vendor->pricelists->min('harga') ?? 0;
            $rating = $vendor->reviews->avg('rating') ?? 0;
            $pengalaman = $vendor->transactions->count(); // Ambil jumlah pemakaian jasa

            $n1 = ($harga > 0) ? ($minPrice / $harga) : 0; // Cost
            $n2 = $rating / $maxRating; // Benefit
            $n3 = $pengalaman / $maxPengalaman; // Benefit

            $skor = ($n1 * $w1) + ($n2 * $w2) + ($n3 * $w3);

            return (object) [
                'data' => $vendor,
                'skor' => $skor,
                'harga_tampil' => $harga,
                'rating_tampil' => $rating,
                'pengalaman_tampil' => $pengalaman
            ];
        });

        $rekomendasi = $hasil->sortByDesc('skor');

        return view('home', [
            'vendors' => $rekomendasi,
            'old_input' => $request->all(),
            'error' => null,
            'categories' => $categories,
            'kecamatans' => $kecamatans
        ]);
    }
}
