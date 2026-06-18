<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use App\Models\Project;

class DummyPortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama jika ingin mengulang seed
        Project::truncate();

        // Siapkan kumpulan link gambar Unsplash yang valid per kategori
        $categoryImages = [
            'Katering' => [
                'https://images.unsplash.com/photo-1555244162-803834f70033?w=600&q=80',
                'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=80',
                'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=600&q=80',
                'https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?w=600&q=80',
            ],
            'Dekorasi' => [
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=600&q=80',
                'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=600&q=80',
                'https://images.unsplash.com/photo-1478146896981-b80fe463b330?w=600&q=80',
            ],
            'Makeup Artist (MUA)' => [
                'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=600&q=80',
                'https://images.unsplash.com/photo-1522337660859-02fbefca4702?w=600&q=80',
                'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=600&q=80',
            ],
            'Fotografer' => [
                'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=600&q=80',
                'https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?w=600&q=80',
                'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=600&q=80',
                'https://images.unsplash.com/photo-1514916726007-68847f06dd03?w=600&q=80',
            ],
            'Hiburan (Band/DJ)' => [
                'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=600&q=80',
                'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=600&q=80',
            ],
            'MC' => [
                'https://images.unsplash.com/photo-1453738773917-9c3eff1db985?w=600&q=80',
                'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=600&q=80',
                'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=600&q=80',
            ],
        ];

        // Ambil semua vendor aktif
        $vendors = Vendor::where('is_verified', true)->with('category')->get();

        foreach ($vendors as $vendor) {
            $catName = $vendor->category->name ?? 'Katering';
            // Default gambar jika kategori tidak terdeteksi
            $imagePool = $categoryImages[$catName] ?? $categoryImages['Katering'];

            // Buat 3-5 portofolio per vendor
            $jumlahPorto = rand(3, 5);

            for ($i = 1; $i <= $jumlahPorto; $i++) {
                // Pilih gambar acak dari pool sesuai kategori
                $imgUrl = $imagePool[array_rand($imagePool)];
                
                Project::create([
                    'vendor_id'     => $vendor->id,
                    'judul_project' => 'Portofolio ' . $catName . ' ' . $i . ' by ' . $vendor->nama_bisnis,
                    'tanggal_acara' => now()->subDays(rand(10, 300))->format('Y-m-d'),
                    'deskripsi'     => 'Ini adalah contoh deskripsi portofolio acara yang sukses kami tangani. Momen indah ini diabadikan sebagai referensi kualitas layanan kami.',
                    'cover_image'   => $imgUrl,
                ]);
            }
        }
    }
}
