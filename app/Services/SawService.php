<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Vendor;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
 * SAW (Simple Additive Weighting) Service
 *
 * Mengisolasi seluruh logika algoritma rekomendasi vendor dari Controller.
 * Bertanggung jawab atas: ekstraksi kriteria, normalisasi matriks,
 * dan perangkingan akhir.
 *
 * Kriteria:
 *  - C1: Harga (Cost)    → semakin rendah semakin baik → min / nilai
 *  - C2: Rating (Benefit) → semakin tinggi semakin baik → nilai / max
 *  - C3: Pengalaman (Benefit) → jumlah transaksi → nilai / max
 */
class SawService
{
    /**
     * Nilai maksimum rating yang mungkin (skala 1–5).
     */
    private const MAX_RATING_SCALE = 5.0;

    /**
     * Nama kecamatan di Kota Banda Aceh.
     */
    public const KECAMATANS = [
        'Baiturrahman', 'Banda Raya', 'Jaya Baru', 'Kuta Alam',
        'Kuta Raja', 'Lueng Bata', 'Meuraxa', 'Syiah Kuala', 'Ulee Kareng',
    ];

    /**
     * Mengambil dan memfilter vendor dari database dengan Eager Loading penuh.
     *
     * Menggunakan `withMin`, `withAvg`, dan `withCount` (Eloquent Aggregate)
     * agar perhitungan dilakukan di sisi DATABASE, bukan PHP, untuk
     * menghindari N+1 dan konsumsi memori berlebih.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchFilteredVendors(Request $request): \Illuminate\Database\Eloquent\Collection
    {
        $query = Vendor::query()
            ->where('is_verified', true)
            // Aggregate langsung di query → satu JOIN, bukan N+1 loop
            ->withMin('pricelists', 'harga')
            ->withAvg('reviews', 'rating')
            ->withCount('transactions')
            ->with(['category', 'address']);

        if ($request->filled('max_budget')) {
            $budget = (int) $request->input('max_budget');
            $query->whereHas('pricelists', fn ($q) => $q->where('harga', '<=', $budget));
        }

        if ($request->filled('kategori')) {
            $query->where('category_id', (int) $request->input('kategori'));
        }

        if ($request->filled('kecamatan')) {
            $kecamatan = $request->input('kecamatan');
            $query->whereHas('address', fn ($q) => $q->where('kecamatan', $kecamatan));
        }

        return $query->get();
    }

    /**
     * Menormalisasi bobot input pengguna menjadi nilai desimal (jumlah = 1.0).
     *
     * @param  int  $bobotHarga
     * @param  int  $bobotRating
     * @param  int  $bobotPengalaman
     * @return array{w1: float, w2: float, w3: float}
     */
    public function normalizeWeights(int $bobotHarga, int $bobotRating, int $bobotPengalaman): array
    {
        $total = $bobotHarga + $bobotRating + $bobotPengalaman;

        // Guard: jika semua bobot 0, bagi rata
        if ($total === 0) {
            return ['w1' => 1 / 3, 'w2' => 1 / 3, 'w3' => 1 / 3];
        }

        return [
            'w1' => $bobotHarga / $total,
            'w2' => $bobotRating / $total,
            'w3' => $bobotPengalaman / $total,
        ];
    }

    /**
     * Menjalankan kalkulasi SAW penuh dan mengembalikan Collection
     * yang sudah diurutkan berdasarkan skor tertinggi.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $vendors
     * @param  array{w1: float, w2: float, w3: float}   $weights
     * @return \Illuminate\Support\Collection<int, object>
     */
    public function calculate(
        \Illuminate\Database\Eloquent\Collection $vendors,
        array $weights
    ): Collection {
        if ($vendors->isEmpty()) {
            return collect();
        }

        // --- EKSTRAKSI KRITERIA (Nilai referensi untuk normalisasi) ---
        // Nilai sudah di-aggregate oleh withMin/withAvg/withCount di query,
        // jadi kita hanya membaca properti, tanpa looping lagi.

        $minHarga = $vendors
            ->whereNotNull('pricelists_min_harga')
            ->where('pricelists_min_harga', '>', 0)
            ->min('pricelists_min_harga');

        $maxPengalaman = $vendors->max('transactions_count');

        // --- PERLINDUNGAN DIVIDE-BY-ZERO ---
        // Jika semua vendor tidak punya harga atau transaksi, fallback ke 1
        $safeMinHarga     = ($minHarga > 0) ? (float) $minHarga : 1.0;
        $safeMaxPengalaman = ($maxPengalaman > 0) ? (float) $maxPengalaman : 1.0;

        // --- NORMALISASI & PERANGKINGAN ---
        $hasil = $vendors->map(function (Vendor $vendor) use (
            $safeMinHarga,
            $safeMaxPengalaman,
            $weights
        ): object {
            $harga      = (float) ($vendor->pricelists_min_harga ?? 0);
            $rating     = (float) ($vendor->reviews_avg_rating ?? 0);
            $pengalaman = (int) ($vendor->transactions_count ?? 0);

            // Normalisasi Matriks
            // C1 - Cost:    r = min_kolom / nilai_ij (semakin kecil harga = semakin baik)
            $n1 = ($harga > 0) ? ($safeMinHarga / $harga) : 0.0;

            // C2 - Benefit: r = nilai_ij / max_kolom
            $n2 = $rating / self::MAX_RATING_SCALE;

            // C3 - Benefit: r = nilai_ij / max_kolom
            $n3 = (float) $pengalaman / $safeMaxPengalaman;

            // Nilai Preferensi V = Σ(w_j × r_ij)
            $skor = ($n1 * $weights['w1'])
                  + ($n2 * $weights['w2'])
                  + ($n3 * $weights['w3']);

            return (object) [
                'data'             => $vendor,
                'skor'             => round($skor, 6),
                'harga_tampil'     => $harga,
                'rating_tampil'    => round($rating, 2),
                'pengalaman_tampil' => $pengalaman,
                // Nilai normalisasi untuk keperluan debug / laporan
                'n1' => round($n1, 4),
                'n2' => round($n2, 4),
                'n3' => round($n3, 4),
            ];
        });

        return $hasil->sortByDesc('skor')->values();
    }
}
