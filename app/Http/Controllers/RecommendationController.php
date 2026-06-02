<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\SawService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RecommendationController extends Controller
{
    /**
     * Inject SawService melalui constructor (Dependency Injection).
     */
    public function __construct(
        private readonly SawService $sawService
    ) {}

    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $categories  = Cache::remember('categories_all', now()->addHours(6), fn () => Category::all());
        $kecamatans  = SawService::KECAMATANS;

        // Jika tidak ada input pencarian, tampilkan halaman awal
        if (! $request->has('cari')) {
            return view('home', [
                'categories' => $categories,
                'kecamatans' => $kecamatans,
                'old_input'  => [],
            ]);
        }

        // --- Normalisasi Bobot dari Input Pengguna ---
        $weights = $this->sawService->normalizeWeights(
            bobotHarga:      (int) $request->input('bobot_harga', 50),
            bobotRating:     (int) $request->input('bobot_rating', 30),
            bobotPengalaman: (int) $request->input('bobot_pengalaman', 20),
        );

        // --- Bangun Cache Key unik berdasarkan filter & bobot ---
        // Sehingga kombinasi filter yang sama tidak dihitung ulang.
        $cacheKey = 'saw_result_' . md5(serialize($request->only([
            'max_budget', 'kategori', 'kecamatan',
            'bobot_harga', 'bobot_rating', 'bobot_pengalaman',
        ])));

        $rekomendasi = Cache::remember($cacheKey, now()->addMinutes(15), function () use ($request, $weights) {
            $vendors = $this->sawService->fetchFilteredVendors($request);

            if ($vendors->isEmpty()) {
                return null; // Sentinel untuk "tidak ada hasil"
            }

            return $this->sawService->calculate($vendors, $weights);
        });

        // Jika null (dari cache), artinya tidak ada vendor
        if ($rekomendasi === null) {
            return view('home', [
                'error'      => 'Maaf, tidak ada vendor yang cocok dengan filter pencarian Anda.',
                'old_input'  => $request->all(),
                'categories' => $categories,
                'kecamatans' => $kecamatans,
            ]);
        }

        return view('home', [
            'vendors'    => $rekomendasi,
            'old_input'  => $request->all(),
            'error'      => null,
            'categories' => $categories,
            'kecamatans' => $kecamatans,
        ]);
    }
}
