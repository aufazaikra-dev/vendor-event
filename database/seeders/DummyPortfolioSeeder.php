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
                'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800&h=600&fit=crop',
            ],
            'Dekorasi' => [
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1478146059778-26028b07395a?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1591604329141-fb4ad7a3792a?w=800&h=600&fit=crop',
            ],
            'Makeup Artist (MUA)' => [
                'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1457972729786-0411a3b2b626?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?w=800&h=600&fit=crop',
            ],
            'Fotografer' => [
                'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1495121553079-4c61bcce1894?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1554048612-b6a482bc67e5?w=800&h=600&fit=crop',
            ],
            'Hiburan (Band/DJ)' => [
                'https://images.unsplash.com/photo-1501386761578-eaa54b792e25?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&h=600&fit=crop',
            ],
            'MC' => [
                'https://images.unsplash.com/photo-1560523159-4a9692d222f9?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&h=600&fit=crop',
            ],
            'Venue/Gedung' => [
                'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1478147427282-58a87a433469?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800&h=600&fit=crop',
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
