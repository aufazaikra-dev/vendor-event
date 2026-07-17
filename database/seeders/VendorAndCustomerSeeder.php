<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VendorAndCustomerSeeder extends Seeder
{
    // ──────────────────────────────────────────────────────────────
    // URL FOTO UNSPLASH PER KATEGORI
    // ──────────────────────────────────────────────────────────────
    private array $categoryPhotos = [
        'Katering' => [
            'logo'    => 'https://images.unsplash.com/photo-1555244162-803834f70033?w=200&h=200&fit=crop',
            'banner'  => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200&h=400&fit=crop',
            'covers'  => [
                'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800&h=600&fit=crop',
            ],
        ],
        'Dekorasi' => [
            'logo'    => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=200&h=200&fit=crop',
            'banner'  => 'https://images.unsplash.com/photo-1478146059778-26028b07395a?w=1200&h=400&fit=crop',
            'covers'  => [
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1478146059778-26028b07395a?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1591604329141-fb4ad7a3792a?w=800&h=600&fit=crop',
            ],
        ],
        'Makeup Artist (MUA)' => [
            'logo'    => 'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=200&h=200&fit=crop',
            'banner'  => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1200&h=400&fit=crop',
            'covers'  => [
                'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1457972729786-0411a3b2b626?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?w=800&h=600&fit=crop',
            ],
        ],
        'Fotografer' => [
            'logo'    => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=200&h=200&fit=crop',
            'banner'  => 'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=1200&h=400&fit=crop',
            'covers'  => [
                'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1495121553079-4c61bcce1894?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1554048612-b6a482bc67e5?w=800&h=600&fit=crop',
            ],
        ],
        'Hiburan (Band/DJ)' => [
            'logo'    => 'https://images.unsplash.com/photo-1501386761578-eaa54b792e25?w=200&h=200&fit=crop',
            'banner'  => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=1200&h=400&fit=crop',
            'covers'  => [
                'https://images.unsplash.com/photo-1501386761578-eaa54b792e25?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1598387993281-b6c3e5e2e5c3?w=800&h=600&fit=crop',
            ],
        ],
        'MC' => [
            'logo'    => 'https://images.unsplash.com/photo-1560523159-4a9692d222f9?w=200&h=200&fit=crop',
            'banner'  => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=1200&h=400&fit=crop',
            'covers'  => [
                'https://images.unsplash.com/photo-1560523159-4a9692d222f9?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&h=600&fit=crop',
            ],
        ],
        'Venue/Gedung' => [
            'logo'    => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=200&h=200&fit=crop',
            'banner'  => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1200&h=400&fit=crop',
            'covers'  => [
                'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1478147427282-58a87a433469?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=800&h=600&fit=crop',
                'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800&h=600&fit=crop',
            ],
        ],
    ];

    public function run(): void
    {
        // ══════════════════════════════════════════════════════════════
        // TAHAP 1: HAPUS SEMUA DATA LAMA (Kecuali Admin & Kategori & Kota)
        // ══════════════════════════════════════════════════════════════
        $this->command->info('🗑️  Menghapus data lama...');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('reviews')->truncate();
        DB::table('transactions')->truncate();
        DB::table('projects')->truncate();
        DB::table('pricelists')->truncate();
        DB::table('vendor_addresses')->truncate();
        DB::table('vendors')->truncate();
        DB::table('users')->where('role', '!=', 'admin')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅  Data lama berhasil dihapus.');

        // ══════════════════════════════════════════════════════════════
        // TAHAP 2: AMBIL ID KOTA & KATEGORI YANG SUDAH ADA
        // ══════════════════════════════════════════════════════════════
        $cityId = DB::table('cities')->where('slug', 'aceh')->value('id');
        if (!$cityId) {
            $cityId = DB::table('cities')->insertGetId([
                'name' => 'Banda Aceh', 'slug' => 'aceh', 'created_at' => now(), 'updated_at' => now()
            ]);
        }

        $categories = DB::table('categories')->pluck('id', 'name');
        // Pastikan semua 7 kategori ada
        $catNames = ['Katering', 'Dekorasi', 'Makeup Artist (MUA)', 'Fotografer', 'Hiburan (Band/DJ)', 'MC', 'Venue/Gedung'];
        foreach ($catNames as $catName) {
            if (!isset($categories[$catName])) {
                $newId = DB::table('categories')->insertGetId([
                    'name'       => $catName,
                    'slug'       => Str::slug($catName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $categories[$catName] = $newId;
            }
        }

        // ══════════════════════════════════════════════════════════════
        // TAHAP 3: DATA VENDOR PER KATEGORI
        // ══════════════════════════════════════════════════════════════

        // Data alamat khas Banda Aceh (70 entri)
        $addresses = [
            ['jalan' => 'Jl. Teuku Umar No. 12',                   'desa' => 'Peunayong',          'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Pocut Baren No. 5',                   'desa' => 'Keuramat',            'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Sultan Alaidin Mahmudsyah No. 8',     'desa' => 'Ateuk Deah Tengoh',   'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Sri Ratu Safiatuddin No. 17',         'desa' => 'Neusu Aceh',          'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Tgk. Daud Beureueh No. 33',          'desa' => 'Sukaramai',           'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Syiah Kuala No. 22',                  'desa' => 'Rukoh',               'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Lingkar Kampus No. 10',               'desa' => 'Kopelma Darussalam',  'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Prof. Doktor Ali Hasjmy No. 4',       'desa' => 'Beurawe',             'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Haji Mohd Hasan No. 7',              'desa' => 'Cot Mesjid',          'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Prada Utama No. 29',                  'desa' => 'Prada',               'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Mujahidin No. 15',                    'desa' => 'Surien',              'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Cut Nyak Dhien No. 3',                'desa' => 'Lambhuk',             'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Iskandar Muda No. 88',                'desa' => 'Emperom',             'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Tgk. Hamzah Fansuri No. 6',          'desa' => 'Lampuuk',             'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Batoh No. 44',                        'desa' => 'Batoh',               'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Imam Bonjol No. 11',                  'desa' => 'Lamjame',             'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Elang No. 9',                         'desa' => 'Lampulo',             'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Tgk. Chik Ditiro No. 21',            'desa' => 'Laksana',             'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Kuta Raja No. 2',                     'desa' => 'Peulanggahan',        'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Panglima Polim No. 14',               'desa' => 'Merduati',            'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Ahmad Yani No. 40',                   'desa' => 'Geuceu Iniem',        'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Garot No. 19',                        'desa' => 'Lamlagang',           'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Tgk. Imum Lueng Bata No. 31',        'desa' => 'Batoh',               'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Jurong Raya No. 16',                  'desa' => 'Blang Cut',           'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Cot Murong No. 25',                   'desa' => 'Cot Murong',          'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Ulee Lheu No. 53',                    'desa' => 'Ulee Lheu',           'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Banda Aceh - Calang No. 47',          'desa' => 'Cot Lamkuweueh',      'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Teuku Nyak Arief No. 99',             'desa' => 'Darussalam',          'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Inong Balee No. 36',                  'desa' => 'Lam Ara',             'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Kebun Raja No. 27',                   'desa' => 'Lam Lagang',          'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Tgk. Di Bitai No. 18',               'desa' => 'Bitai',               'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Lamprit No. 62',                      'desa' => 'Lamprit',             'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Makam Pahlawan No. 8',                'desa' => 'Lueng Bata',          'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Soekarno Hatta No. 77',               'desa' => 'Punge Jurong',        'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Tgk. Syik Kuala No. 5',              'desa' => 'Doy',                 'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Keramat No. 43',                      'desa' => 'Keramat',             'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Ahmad Dahlan No. 9',                   'desa' => 'Peuniti',             'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Pahlawan No. 67',                     'desa' => 'Setui',               'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Gp. Jawa No. 34',                     'desa' => 'Gp. Jawa',            'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Ulee Kareng No. 56',                  'desa' => 'Ie Masen Ulee Kareng','kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Tibang No. 3',                        'desa' => 'Tibang',              'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Deah Raya No. 11',                    'desa' => 'Deah Raya',           'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Ajun No. 22',                         'desa' => 'Ajun',                'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Tengku Di Anjong No. 15',             'desa' => 'Kampung Baru',        'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Lamgugob No. 39',                     'desa' => 'Lamgugob',            'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Blang Oi No. 28',                     'desa' => 'Blang Oi',            'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Laksana No. 71',                      'desa' => 'Laksana',             'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Lambaro Skep No. 13',                 'desa' => 'Lambaro Skep',        'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Rukoh Utama No. 6',                   'desa' => 'Rukoh',               'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Punge Blang Cut No. 20',              'desa' => 'Punge Blang Cut',     'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Geuceu Komplek No. 55',               'desa' => 'Geuceu Komplek',      'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Lambhuk Raya No. 17',                 'desa' => 'Lambhuk',             'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Meraxa Raya No. 32',                  'desa' => 'Gp. Mulia',           'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Kebun Raya No. 48',                   'desa' => 'Keudah',              'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Garot Baru No. 7',                    'desa' => 'Lamdom',              'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Tanjung No. 26',                      'desa' => 'Lamteumen Barat',     'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Abu Bakar Ash Shiddiq No. 41',        'desa' => 'Ceurih',              'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Hamzah No. 13',                       'desa' => 'Punge Jurong',        'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. T. Nyak Makam No. 8',                 'desa' => 'Seutui',              'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Kp. Mulia No. 49',                    'desa' => 'Gampong Mulia',       'kecamatan' => 'Kuta Alam'],
            // Index 59–69: untuk kategori Venue/Gedung
            ['jalan' => 'Jl. Cut Meutia No. 3',                    'desa' => 'Peuniti',             'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Teuku Umar No. 77',                   'desa' => 'Sukaramai',           'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Muhammad Jam No. 12',                  'desa' => 'Kampung Baru',        'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Diponegoro No. 9',                    'desa' => 'Neusu Jaya',          'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Blang Padang No. 1',                  'desa' => 'Kampung Baru',        'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Stadion H. Dimurthala No. 5',         'desa' => 'Lampineung',          'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Tgk. Chik Pante Kulu No. 20',        'desa' => 'Pante Pirak',         'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Taman Sari No. 8',                    'desa' => 'Taman Sari',          'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Bustanussalatin No. 2',               'desa' => 'Keudah',              'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Banda Raya Indah No. 15',             'desa' => 'Lam Ara',             'kecamatan' => 'Banda Raya'],
        ];

        // ──────────────────────────────────────────────────────────────
        // DEFINISI DATA VENDOR PER KATEGORI
        // ──────────────────────────────────────────────────────────────
        $vendorsData = [

            // ═══════════════════════════════════════════════════════
            // 1. KATERING
            // Harga realistis: Pernikahan min Rp 50.000/orang,
            // Seminar/rapat min Rp 40.000/orang, Snack box min Rp 25.000/pax
            // ═══════════════════════════════════════════════════════
            'Katering' => [
                [
                    'name'   => 'Hidayah Catering',
                    'bisnis' => 'Hidayah Catering Banda Aceh',
                    'slug'   => 'hidayah-catering',
                    'wa'     => '6281234560001',
                    'singkat'=> 'Katering halal premium khas Aceh untuk berbagai acara spesial Anda.',
                    'tentang'=> 'Hidayah Catering hadir sejak 2015, menyajikan masakan khas Aceh dengan cita rasa autentik dan bahan-bahan segar pilihan. Kami melayani pernikahan, sunatan, dan berbagai acara korporat di seluruh Banda Aceh dengan kapasitas hingga 2.000 pax.',
                    'paket'  => [
                        ['Paket Walimah 500 Pax', 27500000,
                         'Harga sudah termasuk: nasi putih pulen, ayam goreng rempah khas Aceh, daging sapi kecap pedas, kuah sop tulang, tumis buncis wortel, kerupuk melinjo, sambal lado hijau, air mineral gelas per tamu. Layanan: prasmanan full setup 5 jam, 10 pramusaji berseragam, setup & bongkar peralatan makan.'],
                        ['Paket Khitan 200 Pax', 11000000,
                         'Harga sudah termasuk: nasi putih, ayam panggang bumbu kecap, ikan goreng kunyit, sayur lodeh, tempe orek, kerupuk udang, sambal tomat, teh manis hangat & air mineral per tamu. Layanan: prasmanan 4 jam, 5 pramusaji, meja & kain penutup meja.'],
                    ],
                    'proyek' => [['Walimah Keluarga Harun', '2024-03-15'], ['Syukuran Kelulusan SMAN 2', '2024-05-20'], ['Aqiqah Keluarga Daud', '2024-07-10']],
                ],
                [
                    'name'   => 'Siti Katering',
                    'bisnis' => 'Siti Katering & Event Aceh',
                    'slug'   => 'siti-katering-aceh',
                    'wa'     => '6281234560002',
                    'singkat'=> 'Spesialis katering acara pernikahan besar dan MICE se-Banda Aceh.',
                    'tentang'=> 'Siti Katering telah dipercaya menangani lebih dari 500 acara pernikahan besar di Banda Aceh. Kami menghadirkan rasa yang konsisten dengan standar kebersihan terjamin dan tim profesional berpengalaman.',
                    'paket'  => [
                        ['Paket Grand Wedding 1000 Pax', 60000000,
                         'Harga sudah termasuk: nasi putih basmati, rendang daging sapi, ayam goreng kalasan, gulai ikan tongkol, tumis kangkung bawang putih, acar timun wortel, kerupuk aci & emping, kolak pisang, es teh manis & air mineral per tamu. Layanan: prasmanan full 6 jam, 20 pramusaji berseragam batik, meja prasmanan berdekorasi, setup & bongkar lengkap.'],
                        ['Paket Maulid Akbar 500 Pax', 25000000,
                         'Harga sudah termasuk: nasi kuning tumpeng khas Aceh, ayam bakar madu, ikan asam pedas, gulai sayur nangka, tempe & tahu goreng bumbu, kerupuk kaleng, air mineral & teh hangat. Layanan: prasmanan 4 jam, 10 pramusaji, meja makan lengkap.'],
                    ],
                    'proyek' => [['Pernikahan Zulfa & Rafi', '2024-02-10'], ['Walimah Akbar BPMA', '2024-04-22'], ['Maulid Masjid Al-Ikhlas', '2024-09-05']],
                ],
                [
                    'name'   => 'Warung Aceh Sari Rasa',
                    'bisnis' => 'Sari Rasa Katering Aceh',
                    'slug'   => 'sari-rasa-katering',
                    'wa'     => '6281234560003',
                    'singkat'=> 'Hadirkan cita rasa masakan Aceh asli untuk setiap piring tamu Anda.',
                    'tentang'=> 'Sari Rasa Katering mengutamakan penggunaan rempah asli Aceh dalam setiap masakan. Kami menyediakan layanan katering box dan prasmanan untuk acara keluarga, rapat kantor, hingga seminar.',
                    'paket'  => [
                        ['Paket Nasi Box Seminar 100 Box', 4500000,
                         'Harga sudah termasuk per box: nasi putih, ayam goreng tepung, tempe orek pedas, tumis tauge, kerupuk udang 2 buah, sambal bawang sachet, air mineral 330ml. Layanan: pengiriman ke lokasi, tersedia box ramah lingkungan.'],
                        ['Paket Prasmanan Keluarga 200 Pax', 11000000,
                         'Harga sudah termasuk: nasi putih, gulai kambing muda, ayam woku belanga, sayur asem segar, oseng tempe tahu, perkedel jagung, kerupuk melinjo, es jeruk peras & air mineral. Layanan: prasmanan 4 jam, 6 pramusaji, taplak meja & alat makan komplit.'],
                    ],
                    'proyek' => [['Rapat Dinas Pemerintah Aceh', '2024-01-18'], ['Wisuda Unsyiah Batch 3', '2024-06-30'], ['Sunatan Massal Puskesmas Ulee Kareng', '2024-08-12']],
                ],
                [
                    'name'   => 'Dapur Khadijah Catering',
                    'bisnis' => 'Dapur Khadijah Catering Halal',
                    'slug'   => 'dapur-khadijah',
                    'wa'     => '6281234560004',
                    'singkat'=> 'Katering halal bersertifikat MUI, dipercaya ratusan keluarga Aceh.',
                    'tentang'=> 'Dapur Khadijah adalah katering halal bersertifikat MUI Aceh. Kami berkomitmen menyajikan makanan higienis, lezat, dan tepat waktu. Melayani dari 50 hingga 3.000 porsi untuk berbagai jenis acara.',
                    'paket'  => [
                        ['Paket Aqiqah 250 Pax', 15000000,
                         'Harga sudah termasuk: nasi putih, kambing guling 2 ekor (disajikan di meja utama), gulai kambing khas Aceh, ayam goreng rempah, urap sayuran, acar kuning, kerupuk kaleng, kurma, teh hangat & air mineral. Layanan: prasmanan 5 jam, 8 pramusaji, hiasan meja tamu.'],
                        ['Paket Makan Siang Kantor 150 Pax', 7500000,
                         'Harga sudah termasuk: nasi putih, ayam balado, ikan bakar kecap, tumis brokoli wortel, tahu sutra bumbu kari, kerupuk udang, sambal tomat segar, buah potong semangka, air mineral gelas per tamu. Layanan: setup prasmanan 3 jam, 5 pramusaji.'],
                    ],
                    'proyek' => [['Aqiqah Bayi Famili Bu Rahma', '2024-03-28'], ['HUT PT Aceh Power', '2024-07-05'], ['Peresmian Gedung BPJPH Aceh', '2024-10-15']],
                ],
                [
                    'name'   => 'Fatimah Food & Catering',
                    'bisnis' => 'Fatimah Food Catering Aceh',
                    'slug'   => 'fatimah-food-catering',
                    'wa'     => '6281234560005',
                    'singkat'=> 'Sajian lengkap mulai nasi box, prasmanan, hingga katering harian kantor.',
                    'tentang'=> 'Fatimah Food melayani kebutuhan katering harian untuk perkantoran dan perumahan, serta katering event spesial. Dengan chef berpengalaman dan armada pengiriman sendiri, kami menjamin ketepatan waktu dan kualitas rasa.',
                    'paket'  => [
                        ['Paket Katering Harian Kantor 50 Porsi', 2200000,
                         'Harga per hari (50 porsi), sudah termasuk: nasi putih, 1 menu utama (daging/ayam bergantian), 1 sayur (tumis/lodeh bergantian), 1 lauk pendamping (tahu/tempe bergantian), kerupuk, sambal, air mineral gelas. Menu berganti setiap hari selama 20 hari kerja/bulan. Pengiriman gratis radius 10 km.'],
                        ['Paket Walimah Sederhana 150 Pax', 8500000,
                         'Harga sudah termasuk: nasi putih, ayam goreng kunyit, tumis daging sapi cabe hijau, kuah sop bening, bakwan jagung goreng, kerupuk melinjo, sambal terasi, es teh manis & air mineral. Layanan: prasmanan 4 jam, 5 pramusaji, taplak meja.'],
                    ],
                    'proyek' => [['Katering Harian RS Zainoel Abidin', '2024-05-01'], ['Walimah Sederhana Keluarga Bustami', '2024-06-14'], ['Makan Siang Seminar Perda', '2024-09-22']],
                ],
                [
                    'name'   => 'Raja Katering Aceh',
                    'bisnis' => 'Raja Katering & Prasmanan Aceh',
                    'slug'   => 'raja-katering-aceh',
                    'wa'     => '6281234560006',
                    'singkat'=> 'Katering terbaik untuk pesta pernikahan mewah di Banda Aceh.',
                    'tentang'=> 'Raja Katering adalah pilihan utama keluarga kelas menengah atas di Banda Aceh. Kami menyediakan paket lengkap mulai dari makanan, dekorasi meja makan, pelayan berseragam, hingga peralatan makan berkualitas.',
                    'paket'  => [
                        ['Paket Royal Wedding Dinner 1000 Pax', 80000000,
                         'Harga sudah termasuk: nasi putih premium, beef rendang padang, ayam goreng kremes, udang saus padang, gado-gado Jakarta, soto Aceh, acar buah, kerupuk kaleng, dodol Aceh & kue khas Aceh, es campur mangkuk & air mineral. Layanan: setup fine dining 6 jam, 25 pramusaji berseragam resmi, dekorasi meja prasmanan bunga segar, peralatan makan stainless steel.'],
                        ['Paket Corporate Buffet Lunch 200 Pax', 12000000,
                         'Harga sudah termasuk: nasi putih, pasta carbonara, ayam roast lemon herb, tumis brokoli bawang putih, salad sayuran segar & dressing, roti sourdough, dessert brownies coklat, juice buah & air mineral. Layanan: buffet international style 3 jam, 8 pramusaji, tablecloth & centerpiece.'],
                    ],
                    'proyek' => [['Resepsi Pernikahan Putri Bupati Aceh Besar', '2024-01-25'], ['Gala Dinner Peringatan HUT Aceh', '2024-04-11'], ['Makan Malam Forum Rektor Indonesia', '2024-11-07']],
                ],
                [
                    'name'   => 'Saifan Katering & Produksi',
                    'bisnis' => 'Saifan Katering Profesional',
                    'slug'   => 'saifan-katering',
                    'wa'     => '6281234560007',
                    'singkat'=> 'Katering profesional dengan tim masak bersertifikat untuk acara Anda.',
                    'tentang'=> 'Saifan Katering menggabungkan keahlian memasak tradisional Aceh dengan teknik modern. Kami memiliki dapur produksi berstandar food safety dan melayani pesanan mulai dari 100 hingga 5.000 porsi.',
                    'paket'  => [
                        ['Paket Pesta Khitan 500 Pax', 30000000,
                         'Harga sudah termasuk: nasi putih, kambing kuah kari rempah (1 ekor per 50 pax), ayam goreng bumbu rujak, tumis buncis wortel cabe, perkedel kentang, sambal goreng ati, kerupuk bawang, kolak pisang ubi, teh manis hangat & air mineral. Layanan: prasmanan 5 jam, 15 pramusaji, kursi & meja lipat tamu (jika dibutuhkan).'],
                        ['Paket Seminar Workshop Fullday 80 Pax', 4800000,
                         'Harga sudah termasuk: coffee break pagi (snack kue basah 3 jenis + teh/kopi), makan siang (nasi, ayam goreng bumbu, sayur cap cay, kerupuk, air mineral gelas), coffee break sore (kue 2 jenis + minuman). Layanan: setup 3x penyajian fullday 08.00–17.00, peralatan makan disposable higienis.'],
                    ],
                    'proyek' => [['Khitanan Putra Pak Dirjen', '2024-02-20'], ['Workshop Wirausaha Muda Aceh', '2024-07-18'], ['Acara Haul Tgk. Di Blang', '2024-08-01']],
                ],
                [
                    'name'   => 'Raudhah Catering Halal',
                    'bisnis' => 'Raudhah Catering & Snack Box',
                    'slug'   => 'raudhah-catering',
                    'wa'     => '6281234560008',
                    'singkat'=> 'Spesialis snack box premium dan katering mini untuk acara formal dan informal.',
                    'tentang'=> 'Raudhah Catering berspecialisasi dalam penyediaan snack box premium dan paket katering skala kecil hingga menengah. Cocok untuk rapat instansi, arisan, dan pesta ulang tahun.',
                    'paket'  => [
                        ['Paket Snack Box Premium 100 Box', 3500000,
                         'Harga per 100 box, isi per box: 1 potong kue bolu gulung pandan, 1 lembar risol mayonnaise, 1 buah lemper ayam, 1 buah onde-onde wijen, 1 cup puding coklat susu, air mineral 220ml. Dikemas dalam box kraft food grade, ada kartu ucapan, pengiriman tepat waktu ke lokasi.'],
                        ['Paket Arisan & Pengajian 60 Pax', 3900000,
                         'Harga sudah termasuk: nasi putih, ayam kuah opor santan, telur balado, tumis kangkung terasi, tempe goreng orek pedas, kerupuk kaleng, pisang rebus, teh hangat & air mineral gelas. Layanan: pengiriman ke lokasi atau diambil sendiri, disajikan dalam wadah prasmanan mini.'],
                    ],
                    'proyek' => [['Rapat Anggaran DPRK Banda Aceh', '2024-03-10'], ['Arisan Ibu PKK Kecamatan Ulee Kareng', '2024-05-05'], ['Peringatan Isra Miraj Masjid Baiturrahman', '2024-07-28']],
                ],
                [
                    'name'   => 'Mulia Katering & Dekorasi',
                    'bisnis' => 'Mulia Katering Banda Aceh',
                    'slug'   => 'mulia-katering-bandaaceh',
                    'wa'     => '6281234560009',
                    'singkat'=> 'Paket all-in katering + koordinasi dekorasi untuk pernikahan impian Anda.',
                    'tentang'=> 'Mulia Katering hadir dengan konsep one-stop-solution: katering lengkap plus koordinasi dekorasi pelaminan dan tenda. Tim 30 orang memastikan acara berjalan sempurna dari awal hingga akhir.',
                    'paket'  => [
                        ['Paket All-In Walimah 500 Pax', 35000000,
                         'Harga sudah termasuk layanan katering: nasi putih, daging sapi masak hitam khas Aceh, ayam goreng rempah, gulai sayur nangka, mie Aceh goreng, acar timun wortel, kerupuk kaleng, kue pukul & kue Aceh, sirup dingin & air mineral. Layanan: prasmanan 5 jam, 15 pramusaji berseragam, koordinasi jadwal dengan vendor dekorasi & tenda.'],
                        ['Paket Syukuran Rumah Baru 200 Pax', 11000000,
                         'Harga sudah termasuk: nasi kuning tumpeng syukuran, lauk komplit (ayam bakar, telur pindang, urap sayur, tempe goreng crispy, perkedel), kerupuk udang, kue tart ucapan, es teh & air mineral. Layanan: prasmanan sederhana 3 jam, 5 pramusaji, dekorasi meja tamu bunga kertas.'],
                    ],
                    'proyek' => [['Resepsi All-In Keluarga Zulkarnaen', '2024-02-03'], ['Walimah + Koordinasi Bu Hj. Mardiana', '2024-06-07'], ['Syukuran Kantor Dinas Pendidikan Aceh', '2024-10-22']],
                ],
                [
                    'name'   => 'Berkah Katering Sejahtera',
                    'bisnis' => 'Berkah Katering & Nasi Kotak Aceh',
                    'slug'   => 'berkah-katering-sejahtera',
                    'wa'     => '6281234560010',
                    'singkat'=> 'Katering berkualitas dengan harga bersahabat untuk semua lapisan masyarakat.',
                    'tentang'=> 'Berkah Katering didirikan dengan misi menyediakan makanan sehat, lezat, dan berkah untuk semua kalangan. Melayani nasi kotak mulai 50 porsi dan prasmanan mulai 100 pax dengan harga sangat kompetitif.',
                    'paket'  => [
                        ['Paket Nasi Kotak Berkah 100 Box', 3500000,
                         'Harga per 100 box, isi per box: nasi putih pulen, ayam goreng atau ikan goreng (bergantian), tumis sayuran, kerupuk udang 2 buah, sambal terasi sachet, buah jeruk, air mineral 220ml. Box kardus tebal berlogo, cocok untuk rapat atau acara keluarga. Minimal order 100 box.'],
                        ['Paket Walimah Berkah 100 Pax', 6000000,
                         'Harga sudah termasuk: nasi putih, ayam ungkep goreng, tumis buncis wortel cabe hijau, tahu goreng bumbu bali, perkedel kentang, kerupuk melinjo, sambal bawang, teh manis & air mineral. Layanan: prasmanan 4 jam, 4 pramusaji, taplak meja polos.'],
                    ],
                    'proyek' => [['Pengajian Rutin RT 05 Ulee Kareng', '2024-04-15'], ['Khatam Al-Quran Dayah Darul Aman', '2024-06-25'], ['Makan Siang Pesantren Ramadhan SMK 1', '2024-03-20']],
                ],
            ],

            // ═══════════════════════════════════════════════════════
            // 2. DEKORASI
            // Harga realistis: dekorasi pelaminan Rp 4–25 juta
            // ═══════════════════════════════════════════════════════
            'Dekorasi' => [
                [
                    'name'   => 'Elsa Dekorasi Wedding',
                    'bisnis' => 'Elsa Wedding Dekorasi Aceh',
                    'slug'   => 'elsa-wedding-dekorasi',
                    'wa'     => '6281234561001',
                    'singkat'=> 'Dekorasi pernikahan mewah dengan sentuhan modern dan Islami.',
                    'tentang'=> 'Elsa Wedding Dekorasi spesialis dalam dekorasi pernikahan bernuansa islami yang mewah dan elegan. Tim desainer berpengalaman siap mewujudkan konsep impian Anda dengan anggaran fleksibel.',
                    'paket'  => [
                        ['Paket Dekorasi Islami Elegan', 7000000,
                         'Sudah termasuk: dekorasi backdrop pelaminan bahan satin putih & emas (lebar 5m), kursi pengantin pelaminan berlapis beludru, karpet merah lorong 20m, dekorasi meja tamu VIP dengan bunga artifisial, backdrop foto corner 1 set, lampu dekorasi fairy light 100m, setup & bongkar oleh tim 6 orang.'],
                        ['Paket Dekorasi Garden Party Outdoor', 5000000,
                         'Sudah termasuk: arkade bunga segar di pintu masuk (tinggi 3m), dekorasi meja tamu 15 meja dengan centerpiece bunga segar, kain tenda parasol 10 unit, lampu tumblr string light 50m, papan nama selamat datang kayu custom, setup & bongkar tim 5 orang.'],
                    ],
                    'proyek' => [['Pernikahan Sari & Andi - Nuansa Gold', '2024-01-20'], ['Walimah Outdoor Keluarga Hasbi', '2024-04-08'], ['Akad Nikah Ballroom Hotel Hermes', '2024-07-14']],
                ],
                [
                    'name'   => 'Indah Dekorasi Nusantara',
                    'bisnis' => 'Indah Dekorasi & Event Aceh',
                    'slug'   => 'indah-dekorasi-nusantara',
                    'wa'     => '6281234561002',
                    'singkat'=> 'Kreasi dekorasi bernuansa adat Aceh dengan motif khas yang memukau.',
                    'tentang'=> 'Indah Dekorasi menghadirkan keindahan budaya Aceh dalam setiap dekorasi. Menggunakan elemen kain songket, ukiran khas Aceh, dan bunga segar lokal untuk menciptakan nuansa pernikahan yang autentik.',
                    'paket'  => [
                        ['Paket Adat Aceh Sempurna', 8500000,
                         'Sudah termasuk: backdrop pelaminan motif ukiran Aceh (5x3m), bahan songket Aceh asli sebagai ornamen panggung, kursi pelaminan berukir emas, karpet merah & kuning emas lorong 25m, dekorasi 20 meja tamu dengan bunga teratai & daun sirih adat, mahar display custom, tumbak & tepak sirih properti adat, tim 8 orang setup & bongkar.'],
                        ['Paket Modern Minimalis', 4000000,
                         'Sudah termasuk: backdrop pelaminan bahan blacu putih dengan aksen geometris emas (4x2,5m), kursi pengantin minimalis, dekorasi meja tamu 10 meja dengan succulents pot, lampu dekorasi hexagonal honeycomb, papan nama ucapan akrilik, tim 4 orang setup & bongkar.'],
                    ],
                    'proyek' => [['Pernikahan Adat Keluarga Teuku Amin', '2024-02-17'], ['Khitanan Adat Keluarga Leube', '2024-05-30'], ['Resepsi Balairung Adat Aceh', '2024-08-24']],
                ],
                [
                    'name'   => 'Zahra Dekorasi & Bunga',
                    'bisnis' => 'Zahra Dekorasi & Rangkaian Bunga',
                    'slug'   => 'zahra-dekorasi-bunga',
                    'wa'     => '6281234561003',
                    'singkat'=> 'Spesialis rangkaian bunga segar dan dekorasi floral untuk pernikahan.',
                    'tentang'=> 'Zahra Dekorasi menghadirkan keindahan bunga segar dalam setiap sentuhan dekorasi. Bekerja sama dengan pemasok bunga lokal terpercaya untuk menghasilkan dekorasi yang segar dan menawan.',
                    'paket'  => [
                        ['Paket Full Floral Wedding', 9000000,
                         'Sudah termasuk: backdrop pelaminan full bunga segar mawar & lily (5x3m), bouquet pengantin mawar merah 50 tangkai, bouquet pengiring 4 set, dekorasi lorong bunga gantung 20m, centerpiece bunga segar 20 meja tamu, flower stand sepasang di pintu masuk, perawatan bunga pada hari H oleh florist kami, tim 6 orang setup & bongkar.'],
                        ['Paket Floral Minimalis', 3500000,
                         'Sudah termasuk: backdrop pelaminan bunga segar pilihan (warna sesuai tema) 4x2,5m, bouquet pengantin 30 tangkai mawar, dekorasi lorong bunga gantung 10m, centerpiece 10 meja tamu dengan bunga seasonal, tim 4 orang setup & bongkar.'],
                    ],
                    'proyek' => [['Pernikahan Bunga Segar Tema Rose Garden', '2024-03-05'], ['Reuni Akbar SMAN 3 Banda Aceh', '2024-06-10'], ['Peluncuran Produk Kosmetik Aceh', '2024-09-18']],
                ],
                [
                    'name'   => 'Azzam Event & Dekorasi',
                    'bisnis' => 'Azzam Event Organizer & Dekorasi',
                    'slug'   => 'azzam-event-dekorasi',
                    'wa'     => '6281234561004',
                    'singkat'=> 'Event organizer plus dekorasi untuk semua jenis acara besar dan kecil.',
                    'tentang'=> 'Azzam Event menyediakan layanan lengkap event organizer dan dekorasi. Dari pesta ulang tahun hingga acara korporat berskala besar, tim profesional kami siap menangani semuanya dengan penuh perhatian.',
                    'paket'  => [
                        ['Paket EO + Dekorasi Pernikahan Lengkap', 20000000,
                         'Sudah termasuk layanan EO: koordinasi rundown hari H, 2 koordinator on-site. Dekorasi: backdrop pelaminan premium (5x4m), dekorasi 25 meja tamu, karpet merah 30m, papan selamat datang & nama meja tamu. Vendor koordinasi: sound system, pencahayaan stage, dokumentasi foto. Tim 10 orang, setup D-1 & bongkar D+1.'],
                        ['Paket EO Ulang Tahun Mewah', 8000000,
                         'Sudah termasuk: backdrop foto tema custom (3x2m), dekorasi balon arch & pillar, dekorasi meja 10 set, cake table & dessert corner, photo booth properti 1 set, sound system portable, koordinator acara 1 orang fullday, bongkar & bersih setelah acara.'],
                    ],
                    'proyek' => [['Ulang Tahun Silver Keluarga Zaidin', '2024-01-30'], ['Pelantikan Rektor Unsyiah', '2024-03-14'], ['Walimah + EO Lengkap Bu Hj. Ismiati', '2024-08-09']],
                ],
                [
                    'name'   => 'Cantik Dekorasi Pernikahan',
                    'bisnis' => 'Cantik Dekorasi Aceh',
                    'slug'   => 'cantik-dekorasi-aceh',
                    'wa'     => '6281234561005',
                    'singkat'=> 'Dekorasi cantik dan estetik untuk hari bahagia yang tak terlupakan.',
                    'tentang'=> 'Cantik Dekorasi hadir untuk menjadikan setiap momen pernikahan terasa sempurna. Dengan portofolio lebih dari 300 acara, kami ahli mengeksekusi berbagai tema dari rustic, bohemian, modern, hingga tradisional Aceh.',
                    'paket'  => [
                        ['Paket Bohemian Chic', 6500000,
                         'Sudah termasuk: backdrop pelaminan bahan burlap & macramé (4x3m) dengan ornamen bulu & ranting kering, kursi kayu natural pasangan, karpet bulu putih pelaminan, dekorasi dreamcatcher gantung 5 buah, lampu bohlam vintage string 50m, centerpiece 15 meja bunga kering & lilin jar, papan nama kayu laser cut, tim 6 orang setup & bongkar.'],
                        ['Paket Rustic Garden Outdoor', 4500000,
                         'Sudah termasuk: arbor kayu alami dengan tanaman rambat (tinggi 2,5m), dekorasi meja piknik 10 set dengan taplak linen, mason jar floral centerpiece, lantern lilin 20 buah, papan nama kayu chalk, karpet kecil pelaminan, lampu string solar 30m, tim 4 orang setup & bongkar.'],
                    ],
                    'proyek' => [['Pernikahan Tema Bohemian Mira & Faiz', '2024-04-12'], ['Foto Pre-Wedding Outdoor Couple Aceh', '2024-06-22'], ['Pesta Kelulusan SMA Tema Garden Party', '2024-07-20']],
                ],
                [
                    'name'   => 'Harmoni Dekorasi & EO',
                    'bisnis' => 'Harmoni Dekorasi Aceh',
                    'slug'   => 'harmoni-dekorasi-eo',
                    'wa'     => '6281234561006',
                    'singkat'=> 'Dekorasi harmonis menyatukan tradisi Aceh dan sentuhan kontemporer.',
                    'tentang'=> 'Harmoni Dekorasi berkomitmen menciptakan keseimbangan indah antara nilai adat Aceh dan desain kontemporer. Setiap detail dekorasi dirancang dengan penuh kasih sayang dan profesionalitas.',
                    'paket'  => [
                        ['Paket Harmoni Pernikahan', 7500000,
                         'Sudah termasuk: backdrop pelaminan semi-adat bahan velvet kombinasi kain songket (5x3m), kursi pelaminan berukir gold, karpet merah lorong 20m, dekorasi meja VIP 5 set dengan bunga segar, dekorasi meja tamu 15 set bunga artifisial, foto corner 1 set, lampu chandelier rental, tim 7 orang setup D-1 & bongkar D+1.'],
                        ['Paket Majlis Aqad Nikah', 3000000,
                         'Sudah termasuk: backdrop aqad nikah bahan kain satin putih emas (3x2m), meja aqad berlapis kain dengan bunga segar, kursi pengantin 2 set, karpet merah area aqad, dekorasi lampu gantung LED, pot bunga mawar merah 2 pair, papan nama aqad nikah akrilik, tim 3 orang setup & bongkar.'],
                    ],
                    'proyek' => [['Aqad & Resepsi Keluarga Amiruddin', '2024-02-28'], ['Dekorasi Wisuda Poltekes Aceh', '2024-05-15'], ['Reuni Akbar Alumni Unsyiah Angkatan 99', '2024-10-05']],
                ],
                [
                    'name'   => 'Sinar Dekorasi Profesional',
                    'bisnis' => 'Sinar Dekorasi & Tenda Aceh',
                    'slug'   => 'sinar-dekorasi-tenda',
                    'wa'     => '6281234561007',
                    'singkat'=> 'Penyedia tenda pesta dan dekorasi lengkap untuk outdoor dan indoor.',
                    'tentang'=> 'Sinar Dekorasi menyediakan berbagai pilihan tenda pesta berkualitas tinggi kapasitas 100–3.000 pax. Dikombinasikan dengan dekorasi indah, acara outdoor Anda tetap nyaman dan menawan.',
                    'paket'  => [
                        ['Paket Tenda + Dekorasi Outdoor 500 Pax', 10000000,
                         'Sudah termasuk: tenda stretched PVC kapasitas 500 pax (15x20m), kursi lipat stacking 500 unit, meja bulat 50 unit, karpet merah area masuk, dekorasi panggung pelaminan mini, sound system outdoor, lampu penerangan tent, backdrop foto 1 set, tim 10 orang setup D-1 & bongkar D+1.'],
                        ['Paket Tenda Mini Keluarga 100 Pax', 2500000,
                         'Sudah termasuk: tenda roof minimalis 100 pax (6x10m), kursi lipat 100 unit, meja plastik 10 unit, lampu penerangan tenda, karpet area masuk, tim 4 orang setup & bongkar.'],
                    ],
                    'proyek' => [['Pesta Pernikahan Outdoor Kp. Mulia', '2024-03-22'], ['Acara HUT RI Kecamatan Syiah Kuala', '2024-08-17'], ['Open House Lebaran Keluarga Direktur BPKD', '2024-04-20']],
                ],
                [
                    'name'   => 'Bunga Hati Dekorasi',
                    'bisnis' => 'Bunga Hati Wedding Decoration',
                    'slug'   => 'bunga-hati-dekorasi',
                    'wa'     => '6281234561008',
                    'singkat'=> 'Dekorasi pernikahan bertemakan bunga yang romantis dan penuh kesan.',
                    'tentang'=> 'Bunga Hati Dekorasi mengkhususkan diri pada dekorasi bertemakan bunga dan alam. Kami percaya setiap pernikahan harus memancarkan keindahan alam yang tulus.',
                    'paket'  => [
                        ['Paket Romantic Full Floral Wedding', 8000000,
                         'Sudah termasuk: backdrop pelaminan full bunga segar mix mawar, gerbera, baby breath (5x3m), bouquet pengantin mawar merah premium 60 tangkai, flower wall foto area 2x2m, dekorasi lorong bunga segar 15m, centerpiece 20 meja bunga segar, perawatan bunga oleh florist hari H, tim 6 orang setup & bongkar.'],
                        ['Paket Dekorasi Simple Elegan', 3000000,
                         'Sudah termasuk: backdrop pelaminan bahan satin putih dengan bunga artifisial rangkaian (4x2m), dekorasi meja 10 set centerpiece bunga kering & lilin, karpet area pelaminan, lampu LED string dekorasi, papan nama pasangan akrilik, tim 3 orang setup & bongkar.'],
                    ],
                    'proyek' => [['Pernikahan Tema Floral Romantis Nia & Arif', '2024-01-14'], ['Photo Booth Wisuda Universitas Syiah Kuala', '2024-06-05'], ['Dekorasi Pesta Tunangan Dewi', '2024-07-30']],
                ],
                [
                    'name'   => 'Mahkota Dekorasi & Event',
                    'bisnis' => 'Mahkota Dekorasi Pernikahan Aceh',
                    'slug'   => 'mahkota-dekorasi-event',
                    'wa'     => '6281234561009',
                    'singkat'=> 'Dekorasi pernikahan premium bagaikan mahkota untuk hari bahagia Anda.',
                    'tentang'=> 'Mahkota Dekorasi menghadirkan nuansa kemewahan sesungguhnya dalam setiap acara. Menggunakan bahan-bahan berkualitas tinggi, kristal, dan bunga impor pilihan untuk menciptakan dekorasi yang tak tertandingi.',
                    'paket'  => [
                        ['Paket Mahkota Agung Premium', 25000000,
                         'Sudah termasuk: backdrop pelaminan full kristal swarovski & kain organza premium (6x4m), kursi pelaminan custom gilded emas, karpet mewah bulu 30m, dekorasi kristal gantung 10 titik, bunga impor (mawar belanda, lily, hydrangea) centerpiece 30 meja, canopy bunga impor di lorong masuk, flower stand kristal 4 pair, tim 12 orang setup D-2 & bongkar D+1.'],
                        ['Paket Grand Elegance', 15000000,
                         'Sudah termasuk: backdrop pelaminan bahan premium velvet navy & emas dengan bunga impor (5x3m), kursi pelaminan luxury model throne, karpet premium merah lorong 25m, chandelier rental 3 titik, centerpiece 25 meja bunga impor segar, foto corner luxury 1 set, lampu dekorasi fairy light 200m, tim 9 orang setup D-1 & bongkar D+1.'],
                    ],
                    'proyek' => [['Wedding Mewah di Hermes Palace Hotel', '2024-02-14'], ['Gala Dinner Gubernur Aceh', '2024-04-02'], ['Pernikahan Anak Tokoh Adat Aceh', '2024-09-07']],
                ],
                [
                    'name'   => 'Ananda Dekorasi Kreatif',
                    'bisnis' => 'Ananda Kreatif Dekorasi Aceh',
                    'slug'   => 'ananda-dekorasi-kreatif',
                    'wa'     => '6281234561010',
                    'singkat'=> 'Dekorasi kreatif dengan konsep unik yang mencerminkan kepribadian Anda.',
                    'tentang'=> 'Ananda Dekorasi hadir untuk Anda yang menginginkan konsep berbeda dan tidak biasa. Tim kreatif kami siap merancang dekorasi tematik yang benar-benar personal dan mencerminkan kepribadian pasangan.',
                    'paket'  => [
                        ['Paket Konsep Unik Custom Full Venue', 12000000,
                         'Sudah termasuk: sesi konsultasi desain 2x dengan tim kreatif, pembuatan mood board & sketsa desain, eksekusi dekorasi penuh sesuai tema custom (area pelaminan, lorong, foto corner, meja tamu, pintu masuk), properti desain khusus yang dibuat sendiri (non-standar), tim 8 orang setup D-1 & bongkar D+1, dokumentasi before-after.'],
                        ['Paket Tema Dongeng Romantis', 9000000,
                         'Sudah termasuk: backdrop fairy tale dengan dedaunan hijau & bunga warna pastel (5x3m), kursi mahkota pengantin custom, properti jamur hutan & lentera, lampu warm LED dramatic 150m, photo corner dengan ayunan taman, fog machine effect, tim 7 orang setup & bongkar.'],
                    ],
                    'proyek' => [['Wedding Tema Starry Night Indah & Ridha', '2024-05-25'], ['Ulang Tahun Tema Petualangan Anak TK', '2024-07-01'], ['Pesta Ulang Tahun Dewasa Tema 90s', '2024-09-29']],
                ],
            ],

            // ═══════════════════════════════════════════════════════
            // 3. MAKEUP ARTIST (MUA)
            // ═══════════════════════════════════════════════════════
            'Makeup Artist (MUA)' => [
                [
                    'name'   => 'Riska Makeup Artist',
                    'bisnis' => 'Riska MUA Bridal Aceh',
                    'slug'   => 'riska-mua-bridal',
                    'wa'     => '6281234562001',
                    'singkat'=> 'Spesialis makeup pengantin dengan hasil glowing alami tahan lama.',
                    'tentang'=> 'Riska MUA telah merias lebih dari 800 pengantin cantik di Banda Aceh. Dengan keahlian makeup modern dan tradisional Aceh, Riska menjamin penampilan percaya diri dan cantik sepanjang hari.',
                    'paket'  => [
                        ['Paket Bridal Full Day', 2500000,
                         'Sudah termasuk: makeup pengantin untuk akad nikah (1 look) + touch up & change look untuk resepsi (1 look), produk: foundation full coverage Fenty Beauty, eyeshadow Natasha Denona, lipstik MAC, setting spray NYX. Bahan: false lashes 3D premium, pelembab muka SPF. Layanan: gratis antar ke venue dalam kota Banda Aceh, touch up kit dibawa on-site selama 6 jam.'],
                        ['Paket Makeup Modern Minimalis', 1200000,
                         'Sudah termasuk: 1 look makeup modern soft glam, durasi tahan 5–6 jam, produk: foundation MAC Studio Fix, cushion korea grade A, eyeshadow neutral, lipstik satin merah jambu/merah bata sesuai permintaan, setting spray. Layanan: sesi makeup 1,5 jam, tidak termasuk hairdo.'],
                    ],
                    'proyek' => [['Pengantin Sari - Pernikahan Adat Aceh', '2024-01-20'], ['Rias Pengantin Muslimah Dian', '2024-04-15'], ['Makeup Wisuda Polmed Aceh', '2024-06-28']],
                ],
                [
                    'name'   => 'Meutia Beauty Studio',
                    'bisnis' => 'Meutia Beauty & Bridal Studio',
                    'slug'   => 'meutia-beauty-studio',
                    'wa'     => '6281234562002',
                    'singkat'=> 'Studio kecantikan profesional untuk pengantin dan acara formal.',
                    'tentang'=> 'Meutia Beauty Studio adalah studio kecantikan modern di Banda Aceh yang menyediakan layanan makeup, penataan rambut, dan perawatan kulit pre-wedding. Tim MUA bersertifikat nasional.',
                    'paket'  => [
                        ['Paket Studio Bridal Complete', 3500000,
                         'Sudah termasuk: makeup pengantin 2 look (akad + resepsi) menggunakan produk Huda Beauty & Charlotte Tilbury, hairdo sanggul modern atau hijab styling, perawatan kulit pra-rias (facial mini + masker), false lashes 4D, hand bouquet sewa 1 set untuk sesi foto studio. Layanan: sesi di studio 3 jam, gratis 1 sesi touch up on-site.'],
                        ['Paket Makeup Wisuda & Formal', 800000,
                         'Sudah termasuk: 1 look makeup natural untuk foto wisuda atau acara formal, durasi tahan 4–5 jam, produk: foundation sesuai warna kulit, bedak HD, eyeshadow netral, lipstik satin. Layanan: sesi makeup 1 jam di studio, tidak termasuk hairdo.'],
                    ],
                    'proyek' => [['Studio Shoot Pengantin Mutia & Rizal', '2024-02-10'], ['Makeup Resepsi Anak Pejabat Dinas Aceh', '2024-05-20'], ['Foto Pre-Wedding Couple Banda Aceh', '2024-08-10']],
                ],
                [
                    'name'   => 'Ayu Sari MUA Profesional',
                    'bisnis' => 'Ayu Sari MUA & Hairdo',
                    'slug'   => 'ayu-sari-mua',
                    'wa'     => '6281234562003',
                    'singkat'=> 'MUA profesional spesialisasi hairdo dan sanggul adat Aceh.',
                    'tentang'=> 'Ayu Sari MUA mengkhususkan diri dalam seni tata rias dan tata rambut tradisional Aceh. Keahlian membuat sanggul adat, sirih, dan tepung tawar menjamin penampilan pengantin yang anggun.',
                    'paket'  => [
                        ['Paket Rias Adat Aceh Penuh', 3000000,
                         'Sudah termasuk: makeup full adat Aceh (muka tebal bermartabat), hairdo sanggul adat Aceh dengan hiasan bunga sundang dan perhiasan adat sewa, pakaian pengantin Aceh sewa 1 set (baju meukasah + celana), pemasangan perhiasan emas sewa. Layanan: fullday 8 jam, 1 MUA + 1 asisten, gratis antar dalam kota.'],
                        ['Paket Rias Semi-Adat Modern', 1800000,
                         'Sudah termasuk: makeup modern dengan sentuhan elemen adat Aceh (blush adat, eyeliner tegas), hairdo hijab dengan motif lipatan khas Aceh atau sanggul modern, false lashes natural, produk tahan 6 jam. Layanan: sesi 2,5 jam.'],
                    ],
                    'proyek' => [['Rias Pengantin Adat Aceh Fatimah & Siddiq', '2024-03-08'], ['Rias Penyambutan Tamu Kehormatan', '2024-06-17'], ['Tata Rias Penampilan Seni Budaya Aceh', '2024-09-14']],
                ],
                [
                    'name'   => 'Nadia Glam Studio',
                    'bisnis' => 'Nadia Glam MUA Aceh',
                    'slug'   => 'nadia-glam-studio',
                    'wa'     => '6281234562004',
                    'singkat'=> 'Tampil glam dan percaya diri dengan sentuhan airbrush makeup terbaik.',
                    'tentang'=> 'Nadia Glam Studio mengutamakan teknik makeup yang menonjolkan kecantikan alami setiap klien. Dengan produk premium internasional dan teknik airbrush, hasil makeup tahan dari pagi hingga malam.',
                    'paket'  => [
                        ['Paket Airbrush Glam Bridal', 4000000,
                         'Sudah termasuk: makeup airbrush tahan 10–12 jam menggunakan Dinair Airbrush System & produk Kryolan, 2 look (akad + resepsi), false lashes 5D, contouring & highlighting profesional, hairdo modern sanggul rendah atau hijab crown, touch up kit on-site. Layanan: 1 senior MUA + 1 asisten, gratis antar dalam kota, foto B&A dokumentasi.'],
                        ['Paket Evening Party Glamour', 1500000,
                         'Sudah termasuk: 1 look glam untuk acara malam (smokey eye atau cut crease), foundation full coverage tahan 8 jam, lipstik bold merah/plum, highlight glitter, false lashes dramatic, setting spray waterproof. Layanan: sesi 1,5 jam.'],
                    ],
                    'proyek' => [['Red Carpet Look Rina di Acara Gala Dinner', '2024-01-28'], ['Makeup Pengantin Airbrush Nova & Hendra', '2024-04-30'], ['Rias Fashion Show Batik Aceh di Taman Budaya', '2024-07-15']],
                ],
                [
                    'name'   => 'Dewi Cantik MUA',
                    'bisnis' => 'Dewi Cantik Makeup & Salon',
                    'slug'   => 'dewi-cantik-mua',
                    'wa'     => '6281234562005',
                    'singkat'=> 'Salon kecantikan lengkap dengan layanan makeup dan perawatan rambut.',
                    'tentang'=> 'Dewi Cantik hadir sebagai solusi kecantikan satu atap: makeup artist, salon rambut, dan perawatan kuku. Dengan pengalaman lebih dari 10 tahun melayani pengantin, wisuda, dan acara spesial.',
                    'paket'  => [
                        ['Paket Wedding Full Service', 2800000,
                         'Sudah termasuk: makeup pengantin 2 look menggunakan produk MAC & Maybelline pro, creambath rambut sebelum hairdo (di salon), hairdo sanggul atau hijab styling, perawatan kuku natural (tanpa cat, hanya buff & cuticle care), false lashes natural. Layanan: sesi total 4 jam, gratis satu kali touch up di salon sebelum hari H.'],
                        ['Paket Wisuda Cantik', 650000,
                         'Sudah termasuk: makeup natural wisuda tahan 4 jam, hairdo sederhana (poni disisir, rambut disanggul/dikepang atau hijab simple), perawatan kuku cat merah satu warna, bedak padat untuk touch up sendiri. Layanan: sesi di salon 1,5 jam.'],
                    ],
                    'proyek' => [['Wisuda Mahasiswi Unsyiah Angkatan 2020', '2024-06-08'], ['Makeup Pernikahan Putri Ketua DPRA', '2024-03-25'], ['Beauty Shoot Model Produk Hijab Lokal', '2024-09-02']],
                ],
                [
                    'name'   => 'Fitri Make Over Artist',
                    'bisnis' => 'Fitri Make Over Aceh',
                    'slug'   => 'fitri-make-over',
                    'wa'     => '6281234562006',
                    'singkat'=> 'Make over total untuk penampilan memukau di hari istimewa Anda.',
                    'tentang'=> 'Fitri Make Over Artist spesialis dalam transformasi total penampilan. Tidak hanya makeup, tetapi juga konsultasi warna, pemilihan busana, dan aksesori untuk memastikan keseluruhan penampilan sempurna.',
                    'paket'  => [
                        ['Paket Make Over Total Bridal', 5000000,
                         'Sudah termasuk: konsultasi warna & gaya 1 jam sebelum hari H, makeup airbrush atau konvensional premium 2 look, hairdo profesional, pemilihan busana pengantin dari koleksi sewa (10 pilihan), styling aksesori kepala & perhiasan sewa, false lashes 5D, foto dokumentasi before & after by tim. Layanan: senior MUA + asisten + stylist, 6 jam on-site.'],
                        ['Paket Make Over Prom Night', 1000000,
                         'Sudah termasuk: konsultasi singkat gaya 15 menit, makeup pesta elegan tahan 6 jam, hairdo curly atau straightening sederhana, saran busana (klien bawa sendiri), false lashes natural. Layanan: sesi di studio 2 jam.'],
                    ],
                    'proyek' => [['Total Make Over Pengantin Yanti & Rudi', '2024-02-22'], ['Prom Night SMA 5 Banda Aceh', '2024-05-10'], ['Peluncuran Brand Kosmetik Aceh Baru', '2024-11-03']],
                ],
                [
                    'name'   => 'Lestari Beauty & Bridal',
                    'bisnis' => 'Lestari Beauty Bridal Aceh',
                    'slug'   => 'lestari-beauty-bridal',
                    'wa'     => '6281234562007',
                    'singkat'=> 'Riasan elegan tahan panas untuk pengantin berkulit cerah maupun gelap.',
                    'tentang'=> 'Lestari Beauty spesialis makeup untuk semua jenis dan warna kulit tropis. Menggunakan teknik dan produk khusus untuk menghasilkan makeup tahan panas dan lembab yang sempurna sepanjang hari.',
                    'paket'  => [
                        ['Paket Bride Glow Full Coverage', 2200000,
                         'Sudah termasuk: primer SPF 30 untuk perlindungan panas, foundation tahan cuaca Dermacol + sealer, contouring & blush tahan keringat, eyeshadow tahan air (waterproof 8 jam), lipstik matte tahan lama, false lashes natural, setting spray hold kuat. Layanan: 1 look fullday tanpa touch up perlu, sesi 1,5 jam, gratis antar dalam kota.'],
                        ['Paket Engagement/Tunangan', 900000,
                         'Sudah termasuk: makeup siang elegan untuk foto lamaran atau tunangan, 1 look soft glam tahan 5 jam, lipstik satin merah muda atau coral, eyeshadow shimmer netral, blush natural. Layanan: sesi 1 jam, tidak termasuk hairdo.'],
                    ],
                    'proyek' => [['Pernikahan Outdoor Tema Pantai Siti & Adi', '2024-03-30'], ['Foto Lamaran Keluarga Syahputra', '2024-05-25'], ['Rias Pemain Drama Festival Seni Aceh', '2024-08-20']],
                ],
                [
                    'name'   => 'Anisa Premium MUA',
                    'bisnis' => 'Anisa Premium MUA & Studio',
                    'slug'   => 'anisa-premium-mua',
                    'wa'     => '6281234562008',
                    'singkat'=> 'MUA premium teknik internasional untuk pengantin modern Banda Aceh.',
                    'tentang'=> 'Anisa Premium MUA menghadirkan teknik makeup kelas dunia ke Banda Aceh. Terlatih langsung di Jakarta dan Kuala Lumpur, Anisa menggabungkan tren makeup global dengan pemahaman mendalam tentang kecantikan lokal.',
                    'paket'  => [
                        ['Paket Luxury Bridal Premiere', 7000000,
                         'Sudah termasuk: 2 sesi konsultasi pra-hari H (trial makeup & final fitting), makeup akad premium (Charlotte Tilbury + Dior Beauty) + change look resepsi (glam night), hairdo profesional sanggul mahkota atau hijab styling high-end, false lashes 6D mink, bouquet pinjaman untuk sesi foto, foto dokumentasi B&A profesional. Layanan: 2 MUA senior + 1 asisten, fullday 8 jam on-site.'],
                        ['Paket Foto Pre-Wedding Premium', 1500000,
                         'Sudah termasuk: 1 look makeup editorial untuk foto pre-wedding, produk premium tahan 6 jam, hairdo sesuai konsep foto (studio atau outdoor), false lashes natural-glam, konsultasi singkat gaya 30 menit. Layanan: sesi 2 jam, makeup artist on-location.'],
                    ],
                    'proyek' => [['Pre-Wedding Shoot Internasional Couple', '2024-02-05'], ['Makeup Pengantin Putri Direktur Bank Aceh', '2024-06-15'], ['Fashion Show Final Desainer Aceh di JCC', '2024-10-18']],
                ],
                [
                    'name'   => 'Zahwa MUA Natural Look',
                    'bisnis' => 'Zahwa Natural Beauty Aceh',
                    'slug'   => 'zahwa-mua-natural',
                    'wa'     => '6281234562009',
                    'singkat'=> 'Makeup natural dan segar untuk tampilan cantik apa adanya.',
                    'tentang'=> 'Zahwa MUA percaya pada kecantikan alami setiap wanita. Menggunakan produk halal bersertifikat untuk menghasilkan makeup natural yang menonjolkan fitur cantik asli tanpa terlihat berlebihan.',
                    'paket'  => [
                        ['Paket Natural Bride Glow', 1800000,
                         'Sudah termasuk: primer kulit ringan, foundation ringan buildable coverage (produk halal Wardah Professional), blush coral natural, eyeshadow earth tone, mascara halal, lipstik sheer rose, false lashes natural tipis, setting spray. Layanan: 1 look tahan 7–8 jam, sesi 1,5 jam, gratis antar dalam kota Banda Aceh.'],
                        ['Paket Rias Mama Acara Aqiqah/Khitan', 500000,
                         'Sudah termasuk: makeup natural elegan untuk orang tua acara, foundation medium coverage, bedak wajah, blush soft pink atau peach, eyeshadow shimmer lembut, lipstik satin. Layanan: sesi 45 menit, cocok untuk ibu pengantin atau tuan rumah acara.'],
                    ],
                    'proyek' => [['Pernikahan Natural Look Hana & Fauzan', '2024-04-18'], ['Rias Mama Pengantin di Walimah Keluarga', '2024-07-08'], ['Makeup untuk Foto Profile Resmi Kepala Dinas', '2024-09-30']],
                ],
                [
                    'name'   => 'Salsabila Beauty House',
                    'bisnis' => 'Salsabila Beauty House Aceh',
                    'slug'   => 'salsabila-beauty-house',
                    'wa'     => '6281234562010',
                    'singkat'=> 'Rumah kecantikan lengkap: makeup, hair, nail, dan skincare terpadu.',
                    'tentang'=> 'Salsabila Beauty House adalah rumah kecantikan komprehensif di Banda Aceh. Layanan mencakup makeup profesional, perawatan rambut, nail art, dan konsultasi skincare dalam satu lokasi nyaman.',
                    'paket'  => [
                        ['Paket Queen for a Day Bridal', 4500000,
                         'Sudah termasuk: spa wajah & tubuh 1 jam (scrub & masker), makeup bridal 2 look premium (Huda Beauty + NARS), hairdo sanggul mewah atau hijab styling voluminous, nail art 10 jari tangan & kaki (gel semi-permanent), false lashes 4D, parfum sewa, sesi foto studio 15 menit by tim kami. Layanan: fullday 6 jam, 2 MUA + 1 nail artist + 1 hair stylist.'],
                        ['Paket Pre-Wedding Skincare + Makeup', 1200000,
                         'Sudah termasuk: facial hydrating 45 menit + masker collagen, makeup fotografi natural glow 1 look, false lashes natural, primer & setting spray waterproof. Layanan: sesi total 2,5 jam di beauty house, rekomendasi skincare personalisasi gratis.'],
                    ],
                    'proyek' => [['Full Package Pengantin Rina & Bayu', '2024-01-12'], ['Perawatan Pre-Wedding Couple Keluarga Usman', '2024-03-15'], ['Makeup Artis Lokal untuk Video Klip Aceh', '2024-07-25']],
                ],
            ],

            // ═══════════════════════════════════════════════════════
            // 4. FOTOGRAFER
            // ═══════════════════════════════════════════════════════
            'Fotografer' => [
                [
                    'name'   => 'Aceh Lens Studio',
                    'bisnis' => 'Aceh Lens Photography Studio',
                    'slug'   => 'aceh-lens-studio',
                    'wa'     => '6281234563001',
                    'singkat'=> 'Mengabadikan momen berharga dengan sudut pandang seni yang tinggi.',
                    'tentang'=> 'Aceh Lens Studio adalah tim fotografer profesional berspesialisasi dalam fotografi pernikahan, portrait, dan dokumentasi acara. Peralatan terkini menghasilkan karya yang bercerita lebih dari seribu kata.',
                    'paket'  => [
                        ['Paket Dokumentasi Wedding Full Day', 5000000,
                         'Sudah termasuk: 2 fotografer profesional (kamera Sony A7IV & Canon R6), durasi fullday 10 jam (akad hingga akhir resepsi), minimal 500 foto hasil editing Lightroom, 1 album digital foto pilihan terbaik (50 foto), file RAW tersedia via Google Drive, gratis 1 set cetak foto 4R 20 lembar. Tidak termasuk video.'],
                        ['Paket Foto Keluarga Portrait', 1200000,
                         'Sudah termasuk: 2 jam sesi foto outdoor atau indoor, 1 fotografer kamera mirrorless, 30 foto pilihan hasil editing, file digital resolusi tinggi, 2 lokasi foto dalam kota. Tidak termasuk cetak foto.'],
                    ],
                    'proyek' => [['Wedding Documentation Adnan & Putri', '2024-02-25'], ['Foto Keluarga Annual Keluarga Besar Syamsuddin', '2024-05-18'], ['Dokumentasi Wisuda Batch 2 Politeknik Aceh', '2024-06-30']],
                ],
                [
                    'name'   => 'Hafiz Photography Wedding',
                    'bisnis' => 'Hafiz Wedding Photography Aceh',
                    'slug'   => 'hafiz-wedding-photography',
                    'wa'     => '6281234563002',
                    'singkat'=> 'Ceritakan kisah cinta Anda dalam setiap bingkai foto yang bermakna.',
                    'tentang'=> 'Hafiz Photography mengambil pendekatan storytelling dalam setiap karyanya. Tidak hanya memotret momen, tetapi merasakan emosi dan menceritakannya melalui komposisi dan pencahayaan yang artistik.',
                    'paket'  => [
                        ['Paket Storytelling Wedding Photo + Video', 7500000,
                         'Sudah termasuk: 2 fotografer + 1 videografer, durasi fullday 10 jam, 600 foto hasil editing artis, highlight video 5 menit (format Instagram & YouTube), film dokumentasi lengkap 20–30 menit, file digital semua file, 1 album cetak 30x40cm (20 halaman).'],
                        ['Paket Pre-Wedding Artistik', 2000000,
                         'Sudah termasuk: 1 fotografer senior, sesi foto pre-wedding 3 jam di 2 lokasi, 50 foto hasil editing artistic Lightroom + Photoshop, file digital resolusi tinggi, cetak kanvas 60x90cm 1 buah. Konsultasi konsep foto gratis.'],
                    ],
                    'proyek' => [['Pre-Wedding Senja di Ulee Lheu Irma & Budi', '2024-03-10'], ['Wedding Story Film Pernikahan Eka & Hasan', '2024-05-04'], ['Dokumentasi Kelulusan SMAN 1 Banda Aceh', '2024-06-20']],
                ],
                [
                    'name'   => 'Cahaya Foto Aceh',
                    'bisnis' => 'Cahaya Studio Foto Aceh',
                    'slug'   => 'cahaya-foto-aceh',
                    'wa'     => '6281234563003',
                    'singkat'=> 'Studio foto profesional dengan pencahayaan terbaik untuk semua kebutuhan.',
                    'tentang'=> 'Cahaya Studio Foto adalah studio foto indoor profesional di Banda Aceh. Dilengkapi berbagai background, lighting profesional, dan printer foto berkualitas tinggi untuk sesi individual, keluarga, produk, dan korporat.',
                    'paket'  => [
                        ['Paket Studio Foto Keluarga', 800000,
                         'Sudah termasuk: 1,5 jam sesi foto studio, 5 background pilihan (putih, abu, brick wall, tropical, classic), unlimited outfit change, 1 fotografer + 1 asisten lighting, 20 foto pilihan hasil editing, file digital, cetak foto 4R 10 lembar + 1 cetak 10R 1 lembar.'],
                        ['Paket Foto Produk UMKM', 500000,
                         'Sudah termasuk: 2 jam sesi foto produk (flat lay atau 3D), 1 fotografer produk, 2 background warna, pencahayaan studio, 50 foto produk hasil editing retouching profesional (background clean), file JPG siap upload e-commerce. Tidak termasuk video produk.'],
                    ],
                    'proyek' => [['Foto Produk UMKM Kopi Aceh Gayo', '2024-01-22'], ['Foto Studio Keluarga Besar Hari Raya', '2024-04-25'], ['Foto Profil Resmi Pejabat Pemerintah Aceh', '2024-08-05']],
                ],
                [
                    'name'   => 'Drone Foto Aceh',
                    'bisnis' => 'Drone & Aerial Photography Aceh',
                    'slug'   => 'drone-foto-aceh',
                    'wa'     => '6281234563004',
                    'singkat'=> 'Spesialis foto dan video aerial drone untuk acara dan kebutuhan komersial.',
                    'tentang'=> 'Drone Foto Aceh adalah pionir dalam layanan fotografi dan videografi udara di Banda Aceh. Dengan drone DJI Mavic 3 Pro bersertifikat CAAS, menghasilkan rekaman udara berkualitas cinema.',
                    'paket'  => [
                        ['Paket Aerial Wedding Coverage', 3500000,
                         'Sudah termasuk: 1 pilot drone DJI Mavic 3 Pro bersertifikat, durasi terbang 4 jam (4 baterai), foto aerial 50 frame resolusi 20MP, video highlight drone 3 menit format 4K 30fps, editing & color grading, file digital via Google Drive. Harus ada izin terbang dari pemilik venue. Tidak termasuk fotografer darat.'],
                        ['Paket Pemetaan & Survey Udara', 5000000,
                         'Sudah termasuk: aerial mapping menggunakan DJI Phantom 4 RTK, area pemetaan hingga 50 ha per hari, output ortofoto resolusi 2 cm/pixel, DSM/DTM, laporan PDF teknis, file Agisoft Metashape. Cocok untuk lahan pertanian, kawasan properti, atau konstruksi.'],
                    ],
                    'proyek' => [['Aerial Shot Pernikahan di Pantai Lhok Nga', '2024-03-20'], ['Pemetaan Kawasan Reklamasi Banda Aceh', '2024-07-12'], ['Video Promo Pariwisata Aceh 4K', '2024-10-01']],
                ],
                [
                    'name'   => 'Nurul Foto Wedding',
                    'bisnis' => 'Nurul Foto & Video Aceh',
                    'slug'   => 'nurul-foto-wedding',
                    'wa'     => '6281234563005',
                    'singkat'=> 'Layanan foto dan video pernikahan yang romantis dan penuh kenangan.',
                    'tentang'=> 'Nurul Foto & Video hadir untuk mengabadikan setiap momen pernikahan menjadi karya seni yang abadi. Tim fotografer dan videografer berpengalaman bekerja harmonis menghasilkan output terbaik.',
                    'paket'  => [
                        ['Paket Photo + Video Wedding Full', 9000000,
                         'Sudah termasuk: 2 fotografer + 2 videografer, fullday 10 jam, 700 foto editing, cinematic teaser 3 menit, full wedding film 30–45 menit dengan scoring musik, 1 album hardcover cetak 20x30cm (30 halaman), semua file digital via Google Drive. Termasuk 1 sesi engagement shoot (1 jam).'],
                        ['Paket Hanya Foto Wedding Full Day', 4000000,
                         'Sudah termasuk: 2 fotografer, fullday 10 jam, 300 foto terbaik hasil editing, 1 album digital PDF slideshow, file digital resolusi penuh, cetak foto 4R 30 lembar pilihan.'],
                    ],
                    'proyek' => [['Photo & Cinematic Video Walimah Suheri', '2024-02-17'], ['Dokumentasi Khitanan Masal Desa Lamnyong', '2024-05-12'], ['Foto Prewedding Tema Pantai Romantis', '2024-08-15']],
                ],
                [
                    'name'   => 'Momen Abadi Photography',
                    'bisnis' => 'Momen Abadi Photo Aceh',
                    'slug'   => 'momen-abadi-photography',
                    'wa'     => '6281234563006',
                    'singkat'=> 'Mengabadikan setiap momen penting dalam karya fotografi bermakna.',
                    'tentang'=> 'Momen Abadi Photography percaya foto yang baik adalah foto yang membawa Anda kembali ke momen itu. Pendekatan candid dan natural menangkap emosi dan keceriaan sesungguhnya.',
                    'paket'  => [
                        ['Paket Candid Wedding Full Day', 4500000,
                         'Sudah termasuk: 2 fotografer gaya candid reportase, fullday 10 jam, 400 foto editing natural (no heavy filter), file digital semua foto JPG + 100 foto terpilih editing premium, 1 album digital slideshow MP4. Tidak pakai pose kaku, semua momen natural.'],
                        ['Paket Foto Bayi & Newborn', 700000,
                         'Sudah termasuk: sesi newborn photography 2 jam di studio atau rumah, 1 fotografer + 1 asisten prop stylist, 20 foto editing soft dan warm, prop sewa (basket, selimut, topi bayi, bunga), file digital. Bayi usia 5–14 hari.'],
                    ],
                    'proyek' => [['Candid Wedding Fira & Reza - Tema Vintage', '2024-01-27'], ['Newborn Session Baby Zahra', '2024-04-10'], ['Dokumentasi Konser Amal Musik Aceh', '2024-09-12']],
                ],
                [
                    'name'   => 'Kilau Foto & Film Aceh',
                    'bisnis' => 'Kilau Photography & Videography',
                    'slug'   => 'kilau-foto-film',
                    'wa'     => '6281234563007',
                    'singkat'=> 'Foto dan film dokumentasi acara dengan hasil cinematic yang memukau.',
                    'tentang'=> 'Kilau Foto & Film spesialis dalam pembuatan film dokumentasi pernikahan berkualitas sinematik. Setiap video diedit dengan scoring musik yang tepat untuk menciptakan film pernikahan yang mengharukan.',
                    'paket'  => [
                        ['Paket Cinematic Film Wedding', 12000000,
                         'Sudah termasuk: 2 videografer kamera Sony FX3 + Ronin Gimbal + DJI drone, fullday 10 jam, cinematic film 15–20 menit dengan narasi/suara asli, highlight video Instagram 90 detik, color grading sinematik DaVinci Resolve, scoring musik licensed, 2 fotografer (600+ foto editing), file 4K digital semua materi. Pengiriman via hard disk atau Drive.'],
                        ['Paket Teaser Film Wedding', 5000000,
                         'Sudah termasuk: 1 videografer + 1 fotografer, durasi syuting 8 jam, cinematic teaser 3–5 menit scoring musik, highlight foto 200 edit, color grading profesional. Pengiriman digital.'],
                    ],
                    'proyek' => [['Film Sinematik Pernikahan Indira & Yusuf', '2024-03-15'], ['Teaser Wedding Film yang Viral 200K Views', '2024-06-01'], ['Dokumentasi Film Anniversary 25 Tahun Pernikahan', '2024-11-20']],
                ],
                [
                    'name'   => 'Foto Ceria Keluarga',
                    'bisnis' => 'Foto Ceria & Portrait Aceh',
                    'slug'   => 'foto-ceria-keluarga',
                    'wa'     => '6281234563008',
                    'singkat'=> 'Sesi foto keluarga yang menyenangkan menghasilkan kenangan indah bersama.',
                    'tentang'=> 'Foto Ceria mengkhususkan diri dalam sesi foto keluarga yang fun. Fotografer kami terampil berinteraksi dengan anak-anak dan keluarga untuk menghasilkan foto spontan yang natural dan penuh kebahagiaan.',
                    'paket'  => [
                        ['Paket Family Fun Outdoor', 600000,
                         'Sudah termasuk: 1,5 jam sesi foto outdoor, 1 fotografer, 2 lokasi outdoor dalam kota Banda Aceh, 15 foto terpilih editing natural, file digital. Cocok untuk keluarga 2–8 orang. Koordinasi lokasi dan konsep gratis.'],
                        ['Paket Foto Lebaran Keluarga', 1000000,
                         'Sudah termasuk: 2 jam sesi foto, 1 fotografer, 2 lokasi (outdoor + indoor atau 2 outdoor), 30 foto terpilih editing, file digital JPG. Tersedia paket cetak tambahan optional. Cocok untuk 10–20 orang.'],
                    ],
                    'proyek' => [['Foto Keluarga Besar Lebaran Idul Fitri', '2024-04-13'], ['Sesi Foto Ulang Tahun Anak Keluarga Ridwan', '2024-06-24'], ['Foto Keluarga Sambut Menantu Baru', '2024-09-20']],
                ],
                [
                    'name'   => 'Vista Foto Profesional',
                    'bisnis' => 'Vista Photography Profesional Aceh',
                    'slug'   => 'vista-foto-profesional',
                    'wa'     => '6281234563009',
                    'singkat'=> 'Fotografer korporat dan event profesional untuk instansi dan perusahaan.',
                    'tentang'=> 'Vista Photography melayani kebutuhan fotografi korporat dan event profesional untuk instansi pemerintah, BUMN, dan perusahaan swasta. Hasil berstandar editorial dengan pengiriman cepat.',
                    'paket'  => [
                        ['Paket Dokumentasi Event Korporat', 3000000,
                         'Sudah termasuk: 1 fotografer profesional, 8 jam kerja, 100 foto pilihan editing, pengiriman file digital via Google Drive dalam 24 jam kerja, foto dengan watermark korporat (opsional). Cocok untuk seminar, peluncuran produk, pelantikan pejabat, rapat tahunan.'],
                        ['Paket Foto Profil Karyawan Massal', 1500000,
                         'Sudah termasuk: sesi foto profil profesional untuk 20 orang, background abu atau putih, 2 pose per orang, 1 foto terpilih per orang hasil editing (crop kepala dan dada), file JPG digital per individu. Pengiriman maksimal 3 hari kerja.'],
                    ],
                    'proyek' => [['Foto Profil Massal Karyawan BPKP Aceh', '2024-02-08'], ['Dokumentasi Seminar Internasional di Unsyiah', '2024-05-22'], ['Foto Acara Pelantikan Pejabat Pemkot Aceh', '2024-08-30']],
                ],
                [
                    'name'   => 'Selaras Foto & Video',
                    'bisnis' => 'Selaras Photography & Videography',
                    'slug'   => 'selaras-foto-video',
                    'wa'     => '6281234563010',
                    'singkat'=> 'Paket foto dan video terlengkap dengan harga paling kompetitif di Banda Aceh.',
                    'tentang'=> 'Selaras Foto & Video hadir untuk semua budget. Menawarkan layanan fotografi dan videografi berkualitas dengan harga sangat terjangkau tanpa mengorbankan kualitas output.',
                    'paket'  => [
                        ['Paket Hemat Foto + Video Wedding', 3000000,
                         'Sudah termasuk: 1 fotografer + 1 videografer, 8 jam, 200 foto terpilih editing, video dokumentasi 5 menit format FullHD, file digital semua materi. Tidak termasuk drone dan album cetak.'],
                        ['Paket Super Hemat Foto Saja', 1500000,
                         'Sudah termasuk: 1 fotografer, 6 jam, 150 foto terpilih editing Lightroom, file digital JPG resolusi penuh, 1 album digital slideshow PDF. Tidak termasuk cetak foto.'],
                    ],
                    'proyek' => [['Foto & Video Budget Friendly Keluarga Yusnidar', '2024-01-15'], ['Dokumentasi Nikahan di KUA Sederhana', '2024-04-05'], ['Foto Ulang Tahun Perusahaan ke-10', '2024-09-17']],
                ],
            ],

            // ═══════════════════════════════════════════════════════
            // 5. HIBURAN (BAND/DJ)
            // ═══════════════════════════════════════════════════════
            'Hiburan (Band/DJ)' => [
                [
                    'name'   => 'Gita Nusantara Band Aceh',
                    'bisnis' => 'Gita Nusantara Live Band',
                    'slug'   => 'gita-nusantara-band',
                    'wa'     => '6281234564001',
                    'singkat'=> 'Band profesional pembawa suasana hangat untuk pesta pernikahan Anda.',
                    'tentang'=> 'Gita Nusantara adalah band live yang telah tampil di lebih dari 400 acara pernikahan di Banda Aceh. Repertoire lagu luas (pop Indonesia, melayu, dangdut, hits internasional) menjamin suasana pesta tetap meriah.',
                    'paket'  => [
                        ['Paket Band Live 4 Jam Wedding', 5000000,
                         'Sudah termasuk: 5 personil (vokal, gitar, bass, keyboard, drum), sound system 2x10K watt dengan monitor panggung, 4 jam penampilan (2 sesi × 2 jam dengan jeda), repertoire 40+ lagu pilihan tamu, lighting panggung basic, MC announcer saat band tampil, setup & soundcheck 2 jam sebelum acara.'],
                        ['Paket Band Live 2 Jam Gathering', 2500000,
                         'Sudah termasuk: 5 personil, sound system portable 5K watt, 2 jam tampil nonstop, 20+ lagu pilihan tamu (pop, jazz, dangdut pilihan). Cocok untuk gathering kantor atau pesta internal.'],
                    ],
                    'proyek' => [['Live Band Resepsi Pernikahan Taufik & Suci', '2024-02-18'], ['Penampilan di Gala Dinner PT Pupuk Iskandar Muda', '2024-05-08'], ['Live Music HUT Kota Banda Aceh di Blang Padang', '2024-08-22']],
                ],
                [
                    'name'   => 'DJ Blaze Aceh',
                    'bisnis' => 'DJ Blaze & Sound System Aceh',
                    'slug'   => 'dj-blaze-aceh',
                    'wa'     => '6281234564002',
                    'singkat'=> 'DJ profesional dengan sound system premium untuk pesta tak terlupakan.',
                    'tentang'=> 'DJ Blaze adalah salah satu DJ terbaik di Banda Aceh dengan pengalaman lebih dari 8 tahun. Mengkhususkan diri dalam EDM, pop, dan dangdut remix yang selalu membuat lantai dansa penuh energi.',
                    'paket'  => [
                        ['Paket DJ Full Night Wedding', 4000000,
                         'Sudah termasuk: 1 DJ profesional (CDJ Pioneer 2000 + DJM 900 Nexus), sound system 10K watt stereo (speaker line array Nexo), 6 jam set (sunset ke tengah malam), lighting: moving head 4 unit + LED flood 6 unit + haze machine, MC DJ announcer, setup & test 3 jam sebelum acara.'],
                        ['Paket DJ Corporate Party Premium', 6000000,
                         'Sudah termasuk: 1 DJ senior, sound system 15K watt, LED video wall 4x3m, moving head 8 unit, laser show RGB, hazer, 6 jam set, MC DJ, setup & rigging tim profesional 5 orang.'],
                    ],
                    'proyek' => [['After Party Resepsi Pernikahan Muda-Mudi', '2024-03-02'], ['DJ Night Corporate Gathering Bank Mandiri Aceh', '2024-06-28'], ['Festival Musik Pemuda Banda Aceh', '2024-08-10']],
                ],
                [
                    'name'   => 'Serunai Orkestra Aceh',
                    'bisnis' => 'Serunai Orkestra & Musik Tradisional',
                    'slug'   => 'serunai-orkestra-aceh',
                    'wa'     => '6281234564003',
                    'singkat'=> 'Kesenian musik tradisional Aceh memperindah setiap momen sakral.',
                    'tentang'=> 'Serunai Orkestra menghadirkan keindahan musik tradisional Aceh seperti Rapai, Serunai, Biola Melayu, dan Tari Saman. Berkomitmen melestarikan seni budaya Aceh sambil memberikan penampilan memukau.',
                    'paket'  => [
                        ['Paket Rapai & Tari Saman Wedding', 3500000,
                         'Sudah termasuk: 12 personil (8 penari saman + 4 musisi rapai), kostum tari adat Aceh lengkap, 2 jam penampilan (terdiri dari: pembukaan tari saman 30 menit, musik rapai 45 menit, penutup tari saman bersama 15 menit), sound system untuk musik, koordinasi MC adat. Tidak termasuk tenda atau dekorasi.'],
                        ['Paket Pembukaan Prosesi Adat Aceh Resmi', 5000000,
                         'Sudah termasuk: prosesi adat lengkap: penyambutan pengantin pria dengan musik serunai & rapai, tari persembahan 15 menit, peusijuek (tepung tawar) dengan doa adat, 3 jam durasi total, 15 personil berpengalaman adat Aceh, kostum adat resmi lengkap.'],
                    ],
                    'proyek' => [['Pembukaan Adat Resepsi Pernikahan Keluarga Datuk', '2024-01-10'], ['Penampilan di Festival Budaya Aceh Tgk. Di Blang', '2024-04-07'], ['Tari Saman Penyambutan Tamu Kenegaraan', '2024-09-25']],
                ],
                [
                    'name'   => 'Harmoni Music Entertainment',
                    'bisnis' => 'Harmoni Music & Entertainment Aceh',
                    'slug'   => 'harmoni-music-aceh',
                    'wa'     => '6281234564004',
                    'singkat'=> 'Paket hiburan lengkap: band live, MC, dan dekorasi panggung untuk acara Anda.',
                    'tentang'=> 'Harmoni Music Entertainment adalah penyedia hiburan komprehensif untuk pernikahan dan event korporat. Menyediakan band live, DJ, MC profesional, dan sound system berkualitas dalam satu paket.',
                    'paket'  => [
                        ['Paket Hiburan Komplit Wedding', 12000000,
                         'Sudah termasuk: band live 5 personil 4 jam + DJ 2 jam, MC profesional fullday, sound system main PA 15K watt + monitor, lighting panggung moving head 6 unit + LED strip dekorasi + haze, dekorasi backdrop panggung 6x3m, rigging & setup tim 8 orang, 10 jam total hiburan (12.00–22.00).'],
                        ['Paket Band + MC Saja', 6000000,
                         'Sudah termasuk: band live 5 personil 5 jam, MC profesional fullday, sound system 10K watt, lighting basic flood & LED. Tidak termasuk DJ dan dekorasi panggung.'],
                    ],
                    'proyek' => [['Hiburan Komplit Pernikahan Rina & Bagas', '2024-02-24'], ['Corporate Year End Party Pertamina Aceh', '2024-12-15'], ['Festival Seni Banda Aceh Taman Budaya', '2024-08-04']],
                ],
                [
                    'name'   => 'Acoustic Nusantara Aceh',
                    'bisnis' => 'Acoustic Nusantara Live Music',
                    'slug'   => 'acoustic-nusantara-aceh',
                    'wa'     => '6281234564005',
                    'singkat'=> 'Duo dan trio akustik elegan untuk acara intimate dan semi-formal.',
                    'tentang'=> 'Acoustic Nusantara menghadirkan musik akustik yang hangat dan menyentuh hati. Duo atau trio kami cocok untuk acara intimate wedding, pesta kebun, peluncuran produk, dan café gathering.',
                    'paket'  => [
                        ['Paket Duo Akustik Intimate Wedding', 2000000,
                         'Sudah termasuk: duo (vokal + gitar akustik), 3 jam tampil (2 sesi 1,5 jam dengan jeda 15 menit), repertoire 25 lagu (pop Indonesia, barat, melayu sesuai request), sound system portable monitor + mic, setup & soundcheck 1 jam sebelum acara.'],
                        ['Paket Trio Akustik Café & Gathering', 1500000,
                         'Sudah termasuk: trio (vokal + gitar + cajon), 2 jam tampil nonstop atau 2 sesi, 20 lagu pilihan, sound system portable, cocok untuk indoor kapasitas di bawah 100 orang.'],
                    ],
                    'proyek' => [['Intimate Wedding Garden Party Kana & Reza', '2024-03-16'], ['Acoustic Night Kafe Solong Coffee Aceh', '2024-06-22'], ['Gathering Alumni Beasiswa LPDP Aceh', '2024-09-07']],
                ],
                [
                    'name'   => 'Sound Spektra Aceh',
                    'bisnis' => 'Sound Spektra Professional Audio',
                    'slug'   => 'sound-spektra-aceh',
                    'wa'     => '6281234564006',
                    'singkat'=> 'Penyedia sound system profesional untuk acara indoor dan outdoor skala besar.',
                    'tentang'=> 'Sound Spektra adalah spesialis audio profesional di Banda Aceh. Menyediakan sound system dari skala intimate hingga konser besar dengan teknisi berpengalaman.',
                    'paket'  => [
                        ['Paket Sound System Wedding Indoor 500 Pax', 4000000,
                         'Sudah termasuk: main PA 10K watt stereo (Nexo PS15 + amp Crown), subwoofer 2 unit, 4 monitor panggung, 4 channel wireless mic (Shure), 2 mic kabel khotbah, mixer Yamaha CL5, teknisi sound 2 orang, setup & test D-1, bongkar D+1. Tidak termasuk lighting.'],
                        ['Paket Sound System Outdoor Besar 1000 Pax', 8000000,
                         'Sudah termasuk: line array PA 20K watt (d&b audiotechnik), subwoofer 4 unit fly, 6 monitor, 8 wireless mic, mixer digital, delay speaker fill, teknisi senior 3 orang, setup & test.'],
                    ],
                    'proyek' => [['Sound System Pernikahan Besar Ballroom Hermes', '2024-02-10'], ['Sound Outdoor Festival Seni Rakyat Aceh', '2024-04-06'], ['Sound Seminar Nasional di Gedung AAC Dayan Dawood', '2024-10-20']],
                ],
                [
                    'name'   => 'Ragam Musik Aceh',
                    'bisnis' => 'Ragam Musik & Hiburan Aceh',
                    'slug'   => 'ragam-musik-aceh',
                    'wa'     => '6281234564007',
                    'singkat'=> 'Ragam pilihan hiburan musik dari tradisional hingga modern untuk semua acara.',
                    'tentang'=> 'Ragam Musik Aceh menyediakan berbagai pilihan genre hiburan musik: dangdut orkes melayu, band pop, qasidah modern, dan musik tradisional Aceh untuk semua jenis acara.',
                    'paket'  => [
                        ['Paket Orkes Melayu Dangdut 4 Jam', 4500000,
                         'Sudah termasuk: 7 personil (vokal wanita + vokal pria + keyboard + bass + drum + gitar + backing), 4 jam tampil, 40+ lagu melayu & dangdut pilihan tamu, sound system 8K watt + monitor, lighting flood basic, MC transisi saat jeda.'],
                        ['Paket Qasidah Modern Islami', 2000000,
                         'Sudah termasuk: 5 personil (3 vokal + rebana + keyboard), 2 jam tampil, 20 lagu shalawat & nasyid modern pilihan, sound system portable, cocok untuk walimah, maulid, dan pengajian akbar.'],
                    ],
                    'proyek' => [['Orkes Melayu Walimah Keluarga Zulkarnain', '2024-01-20'], ['Qasidah Modern Peringatan Maulid Nabi Masjid Raya', '2024-09-16'], ['Hiburan Dangdut HUT Kemerdekaan Desa Kopelma', '2024-08-17']],
                ],
                [
                    'name'   => 'Bintang DJ & Entertainment',
                    'bisnis' => 'Bintang DJ & Entertainment Aceh',
                    'slug'   => 'bintang-dj-entertainment',
                    'wa'     => '6281234564008',
                    'singkat'=> 'DJ dan entertainment fun untuk pesta ulang tahun, wisuda, dan gathering.',
                    'tentang'=> 'Bintang DJ & Entertainment menyediakan layanan DJ dengan nuansa fun dan interaktif. Spesialis acara non-pernikahan: ulang tahun dewasa, wisuda, farewell party, dan team building.',
                    'paket'  => [
                        ['Paket DJ Pesta Ulang Tahun', 2500000,
                         'Sudah termasuk: 1 DJ, sound system 5K watt stereo, lighting disco ball + moving head 2 unit + LED strip, 4 jam set music (EDM, pop hits, request tamu), MC pesta interaktif, game hadiah (bawa hadiah sendiri), setup & bongkar. Cocok indoor kapasitas 100–200 orang.'],
                        ['Paket DJ Wisuda & Farewell', 2000000,
                         'Sudah termasuk: 1 DJ, sound system 5K watt, 3 jam set, karaoke mode (opsional 30 menit), lighting strobo + LED, foto booth mode (kamera polaroid rental +300rb).'],
                    ],
                    'proyek' => [['DJ Pesta Ulang Tahun ke-30 Pak Hendra', '2024-03-03'], ['Wisuda Party Akbar Fakultas Hukum Unsyiah', '2024-06-30'], ['Farewell Party Karyawan Bank Aceh Cabang Simpang', '2024-10-12']],
                ],
                [
                    'name'   => 'Mega Sound & Entertainment',
                    'bisnis' => 'Mega Sound Entertainment Banda Aceh',
                    'slug'   => 'mega-sound-entertainment',
                    'wa'     => '6281234564009',
                    'singkat'=> 'Sound dan entertainment skala besar untuk ribuan penonton.',
                    'tentang'=> 'Mega Sound & Entertainment memiliki kapabilitas menangani acara 10.000+ penonton. Armada sound system line array terlengkap di Aceh dan tim teknisi berpengalaman.',
                    'paket'  => [
                        ['Paket Event Besar Outdoor 5000+ Penonton', 25000000,
                         'Sudah termasuk: line array main PA 50K watt (L-Acoustics K2 atau setara), sub woofer 8 unit ground stack, delay speaker 4 titik, monitor side fill, in-ear monitor sistem, 16 wireless mic Shure Axient, 2 stage box digital, mixer SSL Live L500, teknisi 8 orang (FOH + monitor + RF + stage), genset 200KVA, setup D-2.'],
                        ['Paket Konser Indoor Premium 1000 Pax', 15000000,
                         'Sudah termasuk: main PA 20K watt line array, sub 4 unit, wireless mic 8 channel, mixer Allen & Heath dLive, LED video wall 8x4m rigging, moving head 16 unit, laser RGB, hazer, 5 teknisi profesional.'],
                    ],
                    'proyek' => [['Sound Festival Seni Rakyat Aceh di Blang Padang', '2024-04-05'], ['Konser Artis Nasional di Hermes Palace Hotel', '2024-09-08'], ['Acara Malam Puncak MTQ Provinsi Aceh', '2024-10-22']],
                ],
                [
                    'name'   => 'Musik Indah Aceh',
                    'bisnis' => 'Musik Indah & Hiburan Keluarga',
                    'slug'   => 'musik-indah-aceh',
                    'wa'     => '6281234564010',
                    'singkat'=> 'Hiburan musik menggembirakan untuk acara keluarga dan komunitas.',
                    'tentang'=> 'Musik Indah Aceh menghadirkan hiburan musik hangat untuk berbagai acara keluarga dan komunitas. Dari penampilan kasual arisan hingga semi-formal, kami selalu tampil sepenuh hati.',
                    'paket'  => [
                        ['Paket Musik Keluarga Ceria 2 Jam', 1800000,
                         'Sudah termasuk: duo/trio musik akustik (vokal + gitar + cajon atau keyboard), 2 jam tampil, 20 lagu keluarga pilihan (pop nostalgia, dangdut lawas, melayu), sound system portable monitor + mic, dapat request lagu 1 hari sebelum acara.'],
                        ['Paket Akustik Café & Restaurant Per Malam', 800000,
                         'Sudah termasuk: duo akustik (vokal + gitar), 3 jam set malam, 25 lagu background ambiance (jazz, bossa nova, pop akustik), sound system mini cafe, cocok untuk cafe kapasitas di bawah 60 orang.'],
                    ],
                    'proyek' => [['Musik Akustik Arisan PKK Ibu-Ibu RT', '2024-04-16'], ['Live Akustik Launching Menu Baru Kafe Ulee Kareng', '2024-07-14'], ['Hiburan Musik Gathering Alumni SMP 4', '2024-10-07']],
                ],
            ],

            // ═══════════════════════════════════════════════════════
            // 6. MC
            // ═══════════════════════════════════════════════════════
            'MC' => [
                [
                    'name'   => 'Fadil MC Profesional',
                    'bisnis' => 'Fadil Master of Ceremony Aceh',
                    'slug'   => 'fadil-mc-profesional',
                    'wa'     => '6281234565001',
                    'singkat'=> 'MC pernikahan profesional dengan pembawaan yang hangat dan menghibur.',
                    'tentang'=> 'Fadil adalah MC pernikahan terpercaya di Banda Aceh dengan pengalaman lebih dari 10 tahun. Kemampuan bilingual Indonesia-Aceh membuat Fadil mampu mencairkan suasana dan membuat tamu merasa nyaman.',
                    'paket'  => [
                        ['Paket MC Pernikahan Full Day (Akad + Resepsi)', 2500000,
                         'Sudah termasuk: MC sesi akad nikah (1–1,5 jam: pembukaan, pengumuman prosesi, doa), jeda sesi & persiapan resepsi, MC sesi resepsi (3–4 jam: menyambut tamu, pengumuman hiburan, momen potong kue, penutup), bilingual Indonesia–Aceh, koordinasi rundown dengan panitia. Tidak termasuk sound system.'],
                        ['Paket MC Resepsi Only', 1500000,
                         'Sudah termasuk: MC sesi resepsi saja (4 jam), koordinasi dengan panitia & hiburan, pengumuman agenda resepsi, ucapan terima kasih kepada tamu, penutup acara. Tidak termasuk akad nikah dan sound system.'],
                    ],
                    'proyek' => [['MC Pernikahan Adat Aceh Keluarga Tengku Ahmad', '2024-02-10'], ['MC Acara Peringatan Hari Guru Nasional', '2024-11-25'], ['MC Wisuda Diploma IV Poltek Aceh', '2024-06-15']],
                ],
                [
                    'name'   => 'Rahmah MC & Protokoler',
                    'bisnis' => 'Rahmah MC & Jasa Protokoler',
                    'slug'   => 'rahmah-mc-protokoler',
                    'wa'     => '6281234565002',
                    'singkat'=> 'MC dan protokoler resmi untuk acara kenegaraan dan formal instansi.',
                    'tentang'=> 'Rahmah adalah MC profesional berpengalaman dalam acara formal dan kenegaraan. Dengan latar belakang protokoler pemerintah, memahami tata cara, etika, dan protokol resmi dari tingkat desa hingga provinsi.',
                    'paket'  => [
                        ['Paket MC Acara Formal & Kenegaraan', 3000000,
                         'Sudah termasuk: MC selama 6 jam acara formal, penguasaan tata urutan protokoler (VIP & VVIP entry, pemberian sambutan, pemberian penghargaan), koordinasi teknis dengan panitia 1 hari sebelum acara, gladi bersih, busana resmi sesuai dress code acara. Tidak termasuk sound system.'],
                        ['Paket MC Seminar & Workshop Halfday', 1500000,
                         'Sudah termasuk: MC seminar halfday (4 jam), moderasi 1 sesi diskusi panel (60 menit), pengumuman agenda, koordinasi Q&A, penutup & ucapan terima kasih sponsor. Dapat diminta untuk acara halfday pagi (08.00–12.00) atau sore (13.00–17.00).'],
                    ],
                    'proyek' => [['MC Pelantikan Bupati Aceh Besar', '2024-02-20'], ['MC Seminar Nasional Ekonomi Syariah di Unsyiah', '2024-05-15'], ['Protokoler Kunjungan Presiden ke Aceh', '2024-08-14']],
                ],
                [
                    'name'   => 'Zulkifli MC Hiburan',
                    'bisnis' => 'Zulkifli MC & Stand Up Comedy',
                    'slug'   => 'zulkifli-mc-hiburan',
                    'wa'     => '6281234565003',
                    'singkat'=> 'MC berbakat dengan humor cerdas yang membuat tamu tertawa riang.',
                    'tentang'=> 'Zulkifli adalah MC sekaligus komedian berbakat. Humor yang halus dan tidak menyinggung mampu menghidupkan suasana acara yang paling sepi. Cocok untuk pernikahan, gathering kantor, dan keluarga.',
                    'paket'  => [
                        ['Paket MC + Stand Up Comedy Pernikahan', 3500000,
                         'Sudah termasuk: MC sesi resepsi pernikahan 4 jam (membawakan agenda: sambutan, hiburan, momen spesial, penutup) + 1 set stand up comedy 20 menit (materi keluarga & pernikahan, aman & sopan), bilingual Indonesia–Aceh ringan. Tidak termasuk sound system.'],
                        ['Paket MC Nikahan Ceria Full Day', 2000000,
                         'Sudah termasuk: MC sesi akad (1 jam) + resepsi (4 jam) dengan humor segar, ice breaking tamu, bilingual ringan, koordinasi rundown. Tidak termasuk sound system.'],
                    ],
                    'proyek' => [['MC Pernikahan Penuh Tawa Keluarga Syukri', '2024-01-19'], ['Hiburan Stand Up di Gathering PT Arun Aceh', '2024-04-28'], ['MC Acara Malam Keakraban Mahasiswa Baru Unsyiah', '2024-08-30']],
                ],
                [
                    'name'   => 'Nursyahra MC Elegan',
                    'bisnis' => 'Nursyahra MC Pernikahan Elegan',
                    'slug'   => 'nursyahra-mc-elegan',
                    'wa'     => '6281234565004',
                    'singkat'=> 'MC wanita elegan untuk pernikahan yang berkesan dan bermartabat.',
                    'tentang'=> 'Nursyahra adalah MC pernikahan wanita paling banyak diminati di Banda Aceh. Penampilan rapi, suara memesona, dan kemampuan memandu acara terstruktur menjadikan setiap pernikahan terasa istimewa.',
                    'paket'  => [
                        ['Paket MC Eksklusif Pernikahan Full Day', 3500000,
                         'Sudah termasuk: MC sesi akad nikah (1,5 jam) + resepsi (4–5 jam), busana formal elegant disesuaikan tema, bilingual Indonesia–Aceh fasih, koordinasi dengan vendor (band/DJ/katering/dekorasi) untuk rundown harmonis, 1 kali gladi resik bersama panitia. Tidak termasuk sound system.'],
                        ['Paket MC Pesta Lamaran/Tunangan', 1200000,
                         'Sudah termasuk: MC acara lamaran atau tunangan 2–3 jam, penguasaan prosesi lamaran (pembukaan, seserahan, pemasangan cincin, foto bersama, penutup), busana semi-formal. Tidak termasuk sound system.'],
                    ],
                    'proyek' => [['MC Pernikahan Elegan Ballroom Hermes Palace', '2024-03-09'], ['MC Acara Lamaran Putri Tokoh Masyarakat Aceh', '2024-06-04'], ['MC Peringatan HUT Dharma Wanita Aceh', '2024-08-07']],
                ],
                [
                    'name'   => 'Hendra MC Bilingual',
                    'bisnis' => 'Hendra MC Bilingual Aceh-Indonesia',
                    'slug'   => 'hendra-mc-bilingual',
                    'wa'     => '6281234565005',
                    'singkat'=> 'MC bilingual fasih membawakan acara dalam bahasa Aceh dan Indonesia.',
                    'tentang'=> 'Hendra adalah MC bilingual sangat fasih dalam bahasa Aceh dan Indonesia. Kemampuan bilingualnya sangat dibutuhkan dalam acara pernikahan adat Aceh yang penuh prosesi dan ucapan adat.',
                    'paket'  => [
                        ['Paket MC Adat Aceh Bilingual Full Day', 2200000,
                         'Sudah termasuk: MC seluruh rangkaian adat Aceh (peusijuek, penyambutan pengantin, kenduri adat) dalam bahasa Aceh fasih + Indonesia, hafal prosesi adat 15 tahapan, koordinasi tokoh adat, 6 jam total. Tidak termasuk sound system.'],
                        ['Paket MC Pengajian & Kenduri Adat', 700000,
                         'Sudah termasuk: MC pengajian atau kenduri 3 jam dalam bahasa Aceh, pembacaan susunan acara, pengantar khatam Quran, pengantar ceramah, penutup doa. Tidak termasuk sound system.'],
                    ],
                    'proyek' => [['MC Kenduri Adat Aceh Keluarga Amin', '2024-01-25'], ['MC Maulid Nabi Akbar Masjid Baiturrahman', '2024-09-15'], ['MC Peuyem Breuh Gajah Hadat Pernikahan', '2024-10-30']],
                ],
                [
                    'name'   => 'Safira MC Korporat',
                    'bisnis' => 'Safira MC Profesional Korporat',
                    'slug'   => 'safira-mc-korporat',
                    'wa'     => '6281234565006',
                    'singkat'=> 'MC korporat profesional untuk acara bisnis, seminar, dan launching produk.',
                    'tentang'=> 'Safira adalah MC korporat berpengalaman memandu berbagai acara bisnis, konferensi, dan product launch dari perusahaan-perusahaan terkemuka di Aceh.',
                    'paket'  => [
                        ['Paket MC Corporate Event Fullday', 4000000,
                         'Sudah termasuk: MC selama 8 jam fullday korporat (08.00–17.00), riset konten acara (1 hari sebelum), moderasi 2 sesi diskusi panel, koordinasi dengan panitia & sponsor, segue & pengumuman agenda, ucapan terima kasih penutup, busana formal korporat. Tidak termasuk sound system.'],
                        ['Paket MC Product Launch & Expo Halfday', 2500000,
                         'Sudah termasuk: MC launching produk halfday (4 jam), interaksi audiens & engagement, moderasi Q&A 1 sesi, pengumuman games & hadiah, pengucapan slogan produk. Tidak termasuk sound system.'],
                    ],
                    'proyek' => [['MC Launching Produk Fintech Baru di Aceh', '2024-03-18'], ['MC Annual Meeting PT Bank Aceh Syariah', '2024-05-30'], ['MC Expo UMKM Aceh Kreatif 2024', '2024-11-10']],
                ],
                [
                    'name'   => 'Maulana MC Religi',
                    'bisnis' => 'Maulana MC & Da\'i Muda Aceh',
                    'slug'   => 'maulana-mc-religi',
                    'wa'     => '6281234565007',
                    'singkat'=> 'MC dan da\'i muda membawakan acara pernikahan dengan nuansa Islami.',
                    'tentang'=> 'Maulana adalah MC sekaligus da\'i muda berbakat, spesialis acara-acara Islami. Latar belakang pendidikan agama yang kuat dan kemampuan tilawah yang indah memberikan dimensi spiritual mendalam.',
                    'paket'  => [
                        ['Paket MC + Tilawah + Tausiyah Pernikahan', 2500000,
                         'Sudah termasuk: tilawah Al-Quran pembuka (10–15 menit surat pilihan), tausiyah singkat pernikahan Islami (20 menit), MC akad nikah + resepsi fullday, doa penutup. Bilingual Indonesia–Aceh. Tidak termasuk sound system.'],
                        ['Paket MC Pengajian & Tabligh Akbar', 1500000,
                         'Sudah termasuk: MC pengajian 3–4 jam, pembacaan susunan acara, pengantar tilawah, pengantar penceramah, doa penutup Qunut Nazilah (bila diminta). Tidak termasuk sound system.'],
                    ],
                    'proyek' => [['MC + Tausiyah Walimah Islami Keluarga Irfan', '2024-02-25'], ['Pembawa Acara Tabligh Akbar Masjid Raya', '2024-04-10'], ['MC Peringatan Isra Miraj Pemerintah Kota', '2024-07-28']],
                ],
                [
                    'name'   => 'Tina MC & Presenter',
                    'bisnis' => 'Tina MC & Presenter TV Aceh',
                    'slug'   => 'tina-mc-presenter',
                    'wa'     => '6281234565008',
                    'singkat'=> 'Presenter TV dan MC profesional dengan pengalaman on-air dan on-ground.',
                    'tentang'=> 'Tina adalah presenter TV aktif sekaligus MC profesional. Pengalaman bertahun-tahun di depan kamera membuat Tina sangat percaya diri, luwes, dan mampu beradaptasi dengan berbagai situasi.',
                    'paket'  => [
                        ['Paket MC Live Broadcast Event', 5000000,
                         'Sudah termasuk: MC untuk acara siaran langsung TV atau streaming 4 jam, koordinasi dengan tim produksi (director, floor director), pemanasan penonton, conducting wawancara narasumber (opsional), earpiece monitoring cue, busana on-air disesuaikan konsep. Tidak termasuk sound system & kamera.'],
                        ['Paket MC Award Night & Gala Dinner', 3500000,
                         'Sudah termasuk: MC gala dinner 4 jam (19.00–23.00), pengumuman penghargaan & pemenang, memperkenalkan artis tamu, moderasi sesi foto bersama, penutupan elegan, busana formal gala. Tidak termasuk sound system.'],
                    ],
                    'proyek' => [['MC Live TVRI Aceh Malam Anugerah Pendidikan', '2024-03-12'], ['MC Gala Dinner Anniversary Perusahaan Tambang', '2024-07-18'], ['MC Live Streaming Festival Kuliner Aceh', '2024-10-15']],
                ],
                [
                    'name'   => 'Rizki MC Muda Aceh',
                    'bisnis' => 'Rizki MC Muda & Energik',
                    'slug'   => 'rizki-mc-muda-aceh',
                    'wa'     => '6281234565009',
                    'singkat'=> 'MC muda energik menghidupkan acara anak muda dan generasi Z.',
                    'tentang'=> 'Rizki adalah MC muda dengan energy tinggi dan koneksi kuat dengan audiens muda. Cocok untuk acara kampus, gathering anak muda, pesta ulang tahun, dan acara modern lainnya.',
                    'paket'  => [
                        ['Paket MC Youth Gathering & Campus Event', 1500000,
                         'Sudah termasuk: MC acara kampus atau komunitas 3 jam, ice breaking games interaktif (30 menit), penguasaan materi acara kampus (PKKMB, seminar, festival), pengumuman games & doorprize, penutup energik. Tidak termasuk sound system.'],
                        ['Paket MC Pesta Ulang Tahun Remaja/Dewasa', 1000000,
                         'Sudah termasuk: MC pesta ulang tahun 2 jam, games interaktif untuk tamu, pengumuman ulang tahun + tiup lilin + pemotongan kue, request lagu untuk DJ atau playlist. Tidak termasuk sound system.'],
                    ],
                    'proyek' => [['MC Ospek Mahasiswa Baru Unsyiah 2024', '2024-08-26'], ['MC Ulang Tahun ke-21 Komunitas Pemuda Aceh', '2024-09-21'], ['MC Festival Startup Muda Aceh', '2024-11-14']],
                ],
                [
                    'name'   => 'Ustadzah Khadijah MC',
                    'bisnis' => 'Ustadzah Khadijah MC & Syariah Event',
                    'slug'   => 'ustadzah-khadijah-mc',
                    'wa'     => '6281234565010',
                    'singkat'=> 'MC wanita Islami berpengalaman untuk pengajian, haul, dan acara keagamaan.',
                    'tentang'=> 'Ustadzah Khadijah adalah MC wanita Islami sangat berpengalaman dalam berbagai acara keagamaan di Banda Aceh. Penguasaan bahasa Arab, Aceh, dan Indonesia menjadikannya pilihan utama untuk haul, maulid, dan kenduri.',
                    'paket'  => [
                        ['Paket MC Pengajian Akbar Wanita', 1200000,
                         'Sudah termasuk: MC pengajian wanita 4 jam (trilingual Arab–Aceh–Indonesia), pembacaan tahlil & yasin pembuka, pengantar penceramah wanita, doa qunut & doa panjang penutup, koordinasi panitia wanita. Tidak termasuk sound system.'],
                        ['Paket MC Haul & Peringatan Keagamaan', 1800000,
                         'Sudah termasuk: MC prosesi haul wali atau ulama 5 jam, pembukaan dengan ayat suci, pembacaan riwayat singkat wali (disiapkan panitia), pengantar ratib & maulid, pembacaan doa haul, penutup. Tidak termasuk sound system.'],
                    ],
                    'proyek' => [['MC Pengajian Akbar Ibu-Ibu Majelis Taklim Banda Aceh', '2024-03-08'], ['MC Haul Wali Nanggroe Ke-5', '2024-06-22'], ['MC Musabaqah Tilawatil Quran Tingkat Kota', '2024-08-25']],
                ],
            ],

            // ═══════════════════════════════════════════════════════
            // 7. VENUE / GEDUNG
            // Harga: sewa gedung per event, tidak termasuk katering/dekorasi
            // ═══════════════════════════════════════════════════════
            'Venue/Gedung' => [
                [
                    'name'   => 'Hermes Palace Convention',
                    'bisnis' => 'Hermes Palace Convention Hall Banda Aceh',
                    'slug'   => 'hermes-palace-convention',
                    'wa'     => '6281234566001',
                    'singkat'=> 'Gedung konvensi mewah di jantung Kota Banda Aceh untuk acara besar dan pernikahan premium.',
                    'tentang'=> 'Hermes Palace Convention Hall adalah pilihan utama untuk acara prestisius di Banda Aceh. Dengan kapasitas hingga 2.000 tamu dan fasilitas bintang lima, kami menyediakan ballroom, meeting room, dan area outdoor yang fleksibel untuk pernikahan, konferensi, dan gala dinner.',
                    'paket'  => [
                        ['Paket Sewa Grand Ballroom Wedding (Fullday)', 35000000,
                         'Sudah termasuk sewa venue: ruang ballroom kapasitas 2.000 pax theater style atau 1.200 pax round table, meja bulat 120 unit + kursi stacking 1.200 unit, panggung pelaminan bawaan (8x5m), sound system ballroom bawaan (tidak termasuk band/DJ), pencahayaan ballroom standard, AC sentral 24 jam, parkir VIP 50 kendaraan + parkir umum 500 kendaraan, toilet & mushalla, keamanan 5 petugas. TIDAK termasuk katering, dekorasi tambahan, dan vendor lain.'],
                        ['Paket Sewa Meeting Room Fullday', 5000000,
                         'Sudah termasuk sewa: ruang meeting kapasitas 100 orang, LCD proyektor + layar, sound system meeting (mic meja 8 unit + 2 wireless), papan tulis whiteboard + spidol, meja U-shape atau klasroom, AC, WiFi business, air mineral unlimited (dispenser), resepsionis 1 orang. TIDAK termasuk coffee break dan makan siang.'],
                    ],
                    'proyek' => [['Resepsi Pernikahan Putri Gubernur Aceh', '2024-02-14'], ['Konferensi Nasional Ekonomi Syariah', '2024-05-10'], ['Gala Dinner Peringatan HUT TNI di Aceh', '2024-10-05']],
                ],
                [
                    'name'   => 'Aula Teater Unsyiah',
                    'bisnis' => 'Aula Teater USK Banda Aceh',
                    'slug'   => 'aula-teater-usk',
                    'wa'     => '6281234566002',
                    'singkat'=> 'Aula teater modern dengan akustik terbaik untuk wisuda, seminar, dan seni.',
                    'tentang'=> 'Aula Teater Universitas Syiah Kuala menawarkan fasilitas modern dengan akustik ruangan yang dirancang profesional. Kapasitas 1.200 kursi permanen dengan panggung luas, pencahayaan panggung, dan audio-visual terkini.',
                    'paket'  => [
                        ['Paket Sewa Aula Wisuda Fullday', 15000000,
                         'Sudah termasuk sewa: aula kapasitas 1.200 kursi permanen (baris A–Z), panggung utama 12x6m, backstage 2 ruang, sound system profesional teater (line array + monitor), pencahayaan panggung (follow spot + LED wash), layar LED panggung 6x3m, 2 unit proyektor backup, podium, meja & kursi presidium 10 set, AC sentral, 3 petugas teknis on-site, 2 petugas keamanan. TIDAK termasuk katering dan dekorasi.'],
                        ['Paket Sewa Aula Seminar Nasional Halfday', 8000000,
                         'Sudah termasuk sewa: aula 600 kursi (setengah kapasitas), panggung, sound system, proyektor + layar besar, AC, 2 petugas teknis, parkir. Halfday: 08.00–13.00 atau 13.00–18.00. TIDAK termasuk coffee break dan makan siang.'],
                    ],
                    'proyek' => [['Wisuda Sarjana Unsyiah Semester Genap 2024', '2024-06-20'], ['Seminar Internasional Teknologi Kebencanaan', '2024-04-18'], ['Pertunjukan Seni Budaya Aceh HUT RI', '2024-08-17']],
                ],
                [
                    'name'   => 'Gedung DPRK Banda Aceh',
                    'bisnis' => 'Gedung Serbaguna DPRK Banda Aceh',
                    'slug'   => 'gedung-serbaguna-dprk',
                    'wa'     => '6281234566003',
                    'singkat'=> 'Gedung serbaguna representatif untuk acara resmi dan pertemuan formal.',
                    'tentang'=> 'Gedung Serbaguna DPRK Banda Aceh tersedia untuk disewa masyarakat umum dan instansi. Dilengkapi ruang rapat VIP, lobby luas, dan area parkir memadai untuk kendaraan tamu hingga 300 unit.',
                    'paket'  => [
                        ['Paket Sewa Ruang Pleno Fullday', 7500000,
                         'Sudah termasuk sewa: ruang pleno 300 kursi, podium resmi, sound system (4 wireless mic + 8 mic meja), proyektor + layar 4x3m, AC, papan nama acara, meja presidium 10 kursi, lobby resepsionis, parkir 150 kendaraan, keamanan 3 orang, 2 teknisi. TIDAK termasuk konsumsi dan dekorasi.'],
                        ['Paket Sewa Ruang Rapat VIP Halfday', 3000000,
                         'Sudah termasuk sewa: ruang rapat VIP 50 orang, meja oval, kursi executive, proyektor + layar, 4 mic meja, whiteboard, AC, WiFi, air mineral (dispenser), parkir VIP 20 kendaraan. Halfday 4 jam. TIDAK termasuk konsumsi.'],
                    ],
                    'proyek' => [['Sidang Paripurna DPRK Banda Aceh', '2024-03-20'], ['Musyawarah Perencanaan Pembangunan Kota', '2024-05-28'], ['Pertemuan Forum Masyarakat Sipil Aceh', '2024-09-12']],
                ],
                [
                    'name'   => 'Gedung Wanita Banda Aceh',
                    'bisnis' => 'Gedung Wanita Serbaguna Banda Aceh',
                    'slug'   => 'gedung-wanita-banda-aceh',
                    'wa'     => '6281234566004',
                    'singkat'=> 'Gedung serbaguna nyaman dan terjangkau untuk acara keluarga dan komunitas.',
                    'tentang'=> 'Gedung Wanita Banda Aceh adalah pilihan venue tepat untuk acara keluarga dan pernikahan skala menengah. Berlokasi strategis di pusat kota, kapasitas 500 tamu, harga terjangkau, fasilitas dapur, toilet, dan parkir.',
                    'paket'  => [
                        ['Paket Sewa Gedung Resepsi Nikah Fullday', 4000000,
                         'Sudah termasuk sewa: aula utama kapasitas 500 pax, kursi lipat 500 unit, meja bulat 50 unit, panggung bawaan kecil 4x3m, sound system basic (2 wireless mic + mic kabel), dapur umum untuk katering mandiri, toilet pria & wanita, mushalla, parkir 100 kendaraan, keamanan 2 orang, AC split 10 unit. TIDAK termasuk katering, dekorasi, dan vendor lain.'],
                        ['Paket Sewa Ruang Pertemuan Halfday', 1200000,
                         'Sudah termasuk sewa: ruang 200 kursi, sound system basic, proyektor + layar, AC, toilet, parkir. Halfday 4 jam. TIDAK termasuk konsumsi.'],
                    ],
                    'proyek' => [['Resepsi Pernikahan Keluarga Nasrul', '2024-01-13'], ['Pertemuan PKK Kecamatan Kuta Alam', '2024-04-05'], ['Bazar Produk UMKM Wanita Aceh', '2024-07-22']],
                ],
                [
                    'name'   => 'Balai Kota Event Center',
                    'bisnis' => 'Balai Kota Event Center Banda Aceh',
                    'slug'   => 'balai-kota-event-center',
                    'wa'     => '6281234566005',
                    'singkat'=> 'Venue ikonik di jantung kota untuk acara bernuansa budaya dan kesenian.',
                    'tentang'=> 'Balai Kota Banda Aceh menawarkan venue ikonik dengan arsitektur khas Aceh memadukan tradisi dan modernitas. Tersedia pelataran terbuka dan aula indoor untuk acara budaya, pameran seni, bazar, dan peringatan hari nasional.',
                    'paket'  => [
                        ['Paket Sewa Pelataran Outdoor Festival', 6000000,
                         'Sudah termasuk sewa: area outdoor 3.000 m², instalasi listrik 30.000 watt (20 titik stop kontak), air bersih, toilet portable 4 unit, keamanan 5 petugas 2 hari, parkir lapangan. TIDAK termasuk tenda, panggung, sound system, dan dekorasi (semua vendor mandiri).'],
                        ['Paket Sewa Aula Indoor Pameran 2 Hari', 3500000,
                         'Sudah termasuk sewa: aula 400 pax, 30 slot stand pameran (meja 1x2m per stand), AC, pencahayaan, listrik 10.000 watt, 2 hari sewa. TIDAK termasuk partisi booth, banner, dan branding vendor peserta.'],
                    ],
                    'proyek' => [['Festival Kuliner dan Budaya Aceh 2024', '2024-04-12'], ['Pameran Seni Rupa Seniman Aceh Kontemporer', '2024-06-28'], ['Peringatan Hari Pahlawan Kota Banda Aceh', '2024-11-10']],
                ],
                [
                    'name'   => 'GOR Serbaguna Lampineung',
                    'bisnis' => 'GOR Serbaguna Lampineung Aceh',
                    'slug'   => 'gor-serbaguna-lampineung',
                    'wa'     => '6281234566006',
                    'singkat'=> 'Venue luas kapasitas ribuan orang, ideal untuk expo dan acara massal.',
                    'tentang'=> 'GOR Serbaguna Lampineung adalah venue besar dengan kapasitas luar biasa hingga 5.000 orang berdiri atau 2.500 kursi. Cocok untuk expo produk, pameran kendaraan, konser musik, dan event massal.',
                    'paket'  => [
                        ['Paket Sewa GOR Expo & Pameran 2 Hari', 12000000,
                         'Sudah termasuk sewa: seluruh area GOR indoor 5.000 m², instalasi listrik 100.000 watt (50 titik), area parkir outdoor 1 ha, loading dock 4 pintu, keamanan 10 petugas, toilet 20 unit, 2 hari sewa. TIDAK termasuk booth, dekorasi, sound system, dan vendor lain.'],
                        ['Paket Sewa GOR Resepsi Massal', 9000000,
                         'Sudah termasuk sewa: area GOR 5.000 m², kursi stacking 2.500 unit, meja bulat 250 unit, sound system basic indoor 20K watt, pencahayaan indoor standard, parkir outdoor, keamanan 8 petugas. TIDAK termasuk katering, dekorasi, dan band/DJ.'],
                    ],
                    'proyek' => [['Pameran Otomotif Aceh Motor Show 2024', '2024-03-08'], ['Resepsi Nikah Massal BAZNAS Banda Aceh', '2024-05-22'], ['Konser Amal Gempa Cianjur di Banda Aceh', '2024-08-20']],
                ],
                [
                    'name'   => 'Pendopo Gubernur Aceh',
                    'bisnis' => 'Pendopo Gubernur Aceh Event Venue',
                    'slug'   => 'pendopo-gubernur-aceh-venue',
                    'wa'     => '6281234566007',
                    'singkat'=> 'Venue prestisius untuk acara kenegaraan dan pernikahan kalangan eksekutif.',
                    'tentang'=> 'Pendopo Gubernur Aceh adalah salah satu venue paling prestisius dan bersejarah di Provinsi Aceh. Arsitektur kolonial dan taman asri memberikan nuansa elegan untuk acara high-profile dan pernikahan eksekutif.',
                    'paket'  => [
                        ['Paket Sewa Pendopo Pernikahan Eksekutif', 50000000,
                         'Sudah termasuk sewa: pendopo indoor 500 pax + taman outdoor 2.000 m², sound system protokoler, pencahayaan taman & pendopo, keamanan 15 petugas, protokoler resmi pendamping, parkir VIP 100 kendaraan, mushalla VIP, toilet VIP 4 unit. TIDAK termasuk katering, dekorasi, dan band/hiburan.'],
                        ['Paket Sewa Pendopo Resepsi Kenegaraan', 25000000,
                         'Sudah termasuk sewa: pendopo indoor 300 pax, protokoler 2 petugas, sound system, pencahayaan taman, keamanan 10 petugas, parkir VIP. TIDAK termasuk katering dan dekorasi.'],
                    ],
                    'proyek' => [['Resepsi Pernikahan Anak Pejabat Tinggi Aceh', '2024-02-28'], ['Penyambutan Duta Besar Negara Sahabat', '2024-06-14'], ['Perayaan Hari Ulang Tahun Provinsi Aceh', '2024-11-11']],
                ],
                [
                    'name'   => 'Taman Bustanussalatin Venue',
                    'bisnis' => 'Taman Bustanussalatin Venue Outdoor',
                    'slug'   => 'taman-bustanussalatin-venue',
                    'wa'     => '6281234566008',
                    'singkat'=> 'Taman bersejarah indah untuk resepsi outdoor dan acara alam terbuka.',
                    'tentang'=> 'Taman Bustanussalatin menawarkan venue outdoor unik dengan latar belakang situs bersejarah Kerajaan Aceh. Ideal untuk resepsi pernikahan outdoor, pameran seni terbuka, dan festival kebudayaan.',
                    'paket'  => [
                        ['Paket Sewa Taman Resepsi Outdoor Heritage', 8000000,
                         'Sudah termasuk sewa: area taman 2.000 m², instalasi listrik 15.000 watt, izin penggunaan taman heritage, keamanan 6 petugas, toilet portable 4 unit, area parkir taman. TIDAK termasuk tenda, kursi meja, sound system, katering, dan dekorasi (semua vendor mandiri diperbolehkan).'],
                        ['Paket Sewa Area Foto Pre-Wedding Heritage', 1500000,
                         'Sudah termasuk: akses area foto pre-wedding 3 jam (07.00–10.00 pagi atau 16.00–18.00 sore), pendamping dari pengelola taman, izin foto komersial, 2 spot foto terbaik taman heritage. TIDAK termasuk fotografer dan styling.'],
                    ],
                    'proyek' => [['Resepsi Outdoor Bertema Kerajaan Aceh', '2024-04-27'], ['Pre-Wedding Shoot Heritage Tema Aceh Kuno', '2024-06-09'], ['Festival Seni dan Budaya Aceh di Taman Terbuka', '2024-09-29']],
                ],
                [
                    'name'   => 'Aula Islamic Center Aceh',
                    'bisnis' => 'Aula Islamic Center Banda Aceh',
                    'slug'   => 'aula-islamic-center-aceh',
                    'wa'     => '6281234566009',
                    'singkat'=> 'Venue Islami representatif untuk akad nikah, pengajian besar, dan acara keagamaan.',
                    'tentang'=> 'Aula Islamic Center Aceh adalah venue bernuansa Islami untuk berbagai acara keagamaan dan pernikahan adat Aceh. Dilengkapi ruang wudhu, mushalla, aula utama 800 orang, dan sistem audio berkualitas tinggi.',
                    'paket'  => [
                        ['Paket Sewa Aula Akad Nikah & Resepsi Islami Fullday', 10000000,
                         'Sudah termasuk sewa: aula utama kapasitas 800 pax, panggung aqad nikah 4x3m, sound system islami (mic khotbah + 4 wireless), AC sentral, mushalla terpisah pria & wanita, ruang wudhu, toilet 10 unit, keamanan 4 petugas, parkir 200 kendaraan. TIDAK termasuk katering, dekorasi, dan vendor lain.'],
                        ['Paket Sewa Aula Pengajian Akbar Halfday', 5000000,
                         'Sudah termasuk sewa: aula 600 kursi, sound system (mic khotbah + 4 wireless), AC, toilet, parkir, mushalla. Halfday 5 jam. TIDAK termasuk konsumsi dan dekorasi.'],
                    ],
                    'proyek' => [['Akad Nikah Massal Islami 50 Pasangan', '2024-03-22'], ['Tabligh Akbar Menyambut Ramadhan', '2024-03-09'], ['Pengajian Nasional Musabaqah Tilawatil Quran', '2024-08-12']],
                ],
                [
                    'name'   => 'Villa Bungong Jeumpa',
                    'bisnis' => 'Villa Bungong Jeumpa Wedding Venue',
                    'slug'   => 'villa-bungong-jeumpa',
                    'wa'     => '6281234566010',
                    'singkat'=> 'Villa pernikahan eksklusif dengan taman bunga cantik dan suasana romantis.',
                    'tentang'=> 'Villa Bungong Jeumpa adalah venue pernikahan eksklusif bergaya villa dengan taman bunga tropis yang luas dan indah. Paket pernikahan untuk 50–400 tamu dalam suasana privat, romantis, dan jauh dari keramaian kota.',
                    'paket'  => [
                        ['Paket Sewa Villa Intimate Wedding Fullday', 20000000,
                         'Sudah termasuk sewa: villa utama (aula indoor 150 pax + teras 100 pax), taman bunga outdoor 1.500 m², kamar pengantin 1 malam, kolam kecil area foto, sound system outdoor, pencahayaan taman (fairy light + lampu sorot), parkir 80 kendaraan, keamanan 4 petugas, perawatan taman hari H. TIDAK termasuk katering, dekorasi tambahan, dan band/DJ.'],
                        ['Paket Sewa Taman Garden Party Halfday', 8000000,
                         'Sudah termasuk sewa: area taman bunga 1.500 m², pencahayaan taman dasar, listrik 10.000 watt, parkir, keamanan 3 petugas, 4 jam sewa (sore: 15.00–19.00 atau malam: 18.00–22.00). TIDAK termasuk tenda, kursi meja, katering, dan dekorasi.'],
                    ],
                    'proyek' => [['Intimate Wedding Romantis Nisa & Azhar', '2024-02-10'], ['Garden Party Ulang Tahun Pernikahan Silver', '2024-05-25'], ['Pesta Kebun Launching Buku Penulis Aceh', '2024-10-18']],
                ],
            ],

        ];

        // ──────────────────────────────────────────────────────────────
        // EKSEKUSI: INSERT DATA VENDOR
        // ──────────────────────────────────────────────────────────────
        $addrIndex   = 0;
        $credentials = [];

        foreach ($vendorsData as $categoryName => $vendors) {
            $catId  = $categories[$categoryName];
            $photos = $this->categoryPhotos[$categoryName];
            $this->command->info("📂 Membuat vendor kategori: {$categoryName}");

            foreach ($vendors as $i => $vd) {
                $email    = $vd['slug'] . '@gmail.com';
                $password = strtolower(explode(' ', $vd['name'])[0]) . '123';

                // Buat User
                $userId = DB::table('users')->insertGetId([
                    'name'       => $vd['name'],
                    'email'      => $email,
                    'password'   => Hash::make($password),
                    'role'       => 'vendor',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Buat Vendor (dengan logo & banner)
                $vendorId = DB::table('vendors')->insertGetId([
                    'user_id'           => $userId,
                    'category_id'       => $catId,
                    'city_id'           => $cityId,
                    'nama_bisnis'       => $vd['bisnis'],
                    'slug'              => $vd['slug'],
                    'alamat_lengkap'    => $addresses[$addrIndex]['jalan'] . ', ' . $addresses[$addrIndex]['desa'] . ', Kec. ' . $addresses[$addrIndex]['kecamatan'] . ', Banda Aceh',
                    'deskripsi_singkat' => $vd['singkat'],
                    'tentang_kami'      => $vd['tentang'],
                    'no_whatsapp'       => $vd['wa'],
                    'logo'              => $photos['logo'],
                    'banner_image'      => $photos['banner'],
                    'is_verified'       => false,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);

                // Buat VendorAddress
                DB::table('vendor_addresses')->insert([
                    'vendor_id'  => $vendorId,
                    'jalan'      => $addresses[$addrIndex]['jalan'],
                    'desa'       => $addresses[$addrIndex]['desa'],
                    'kecamatan'  => $addresses[$addrIndex]['kecamatan'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Buat Paket Harga
                foreach ($vd['paket'] as $paket) {
                    DB::table('pricelists')->insert([
                        'vendor_id'   => $vendorId,
                        'nama_paket'  => $paket[0],
                        'harga'       => $paket[1],
                        'fitur_paket' => $paket[2],
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }

                // Buat Portofolio (Projects) - gunakan URL Unsplash sesuai kategori
                foreach ($vd['proyek'] as $j => $proyek) {
                    DB::table('projects')->insert([
                        'vendor_id'     => $vendorId,
                        'judul_project' => $proyek[0],
                        'tanggal_acara' => $proyek[1],
                        'deskripsi'     => 'Dokumentasi acara "' . $proyek[0] . '" yang kami kerjakan dengan penuh dedikasi dan profesionalisme.',
                        'cover_image'   => $photos['covers'][$j % count($photos['covers'])],
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }

                // Simpan kredensial
                $credentials[] = [
                    'type'     => 'VENDOR',
                    'category' => $categoryName,
                    'name'     => $vd['name'],
                    'bisnis'   => $vd['bisnis'],
                    'email'    => $email,
                    'password' => $password,
                ];

                $addrIndex++;
            }
        }

        // ══════════════════════════════════════════════════════════════
        // TAHAP 4: DATA PELANGGAN DUMMY
        // ══════════════════════════════════════════════════════════════
        $this->command->info('👤 Membuat data pelanggan dummy...');

        $customers = [
            ['name' => 'Aisyah Rahmawati',  'email' => 'aisyah.rahmawati@gmail.com',  'password' => 'Pelanggan@2024'],
            ['name' => 'Budi Santoso',       'email' => 'budi.santoso@yahoo.com',       'password' => 'Pelanggan@2024'],
            ['name' => 'Cut Nurul Jannah',   'email' => 'cut.nurul@gmail.com',          'password' => 'Pelanggan@2024'],
            ['name' => 'Darmawan Putra',     'email' => 'darmawan.putra@gmail.com',     'password' => 'Pelanggan@2024'],
            ['name' => 'Elvira Susanti',     'email' => 'elvira.susanti@gmail.com',     'password' => 'Pelanggan@2024'],
            ['name' => 'Fadhil Islamuddin',  'email' => 'fadhil.islamuddin@gmail.com',  'password' => 'Pelanggan@2024'],
            ['name' => 'Gita Permata Sari',  'email' => 'gita.permata@gmail.com',       'password' => 'Pelanggan@2024'],
            ['name' => 'Hendra Wijaya',      'email' => 'hendra.wijaya@gmail.com',      'password' => 'Pelanggan@2024'],
            ['name' => 'Indah Lestari',      'email' => 'indah.lestari@gmail.com',      'password' => 'Pelanggan@2024'],
            ['name' => 'Jailani Muhammad',   'email' => 'jailani.m@gmail.com',          'password' => 'Pelanggan@2024'],
            ['name' => 'Kartika Dewi',       'email' => 'kartika.dewi@gmail.com',       'password' => 'Pelanggan@2024'],
            ['name' => 'Lukman Hakim',       'email' => 'lukman.hakim@gmail.com',       'password' => 'Pelanggan@2024'],
            ['name' => 'Mira Agustina',      'email' => 'mira.agustina@gmail.com',      'password' => 'Pelanggan@2024'],
            ['name' => 'Nazaruddin Syah',    'email' => 'nazaruddin.syah@gmail.com',    'password' => 'Pelanggan@2024'],
            ['name' => 'Olivia Chairunnisa', 'email' => 'olivia.chairu@gmail.com',       'password' => 'Pelanggan@2024'],
        ];

        foreach ($customers as $cust) {
            DB::table('users')->insert([
                'name'       => $cust['name'],
                'email'      => $cust['email'],
                'password'   => Hash::make($cust['password']),
                'role'       => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $credentials[] = [
                'type'     => 'PELANGGAN',
                'category' => '-',
                'name'     => $cust['name'],
                'bisnis'   => '-',
                'email'    => $cust['email'],
                'password' => $cust['password'],
            ];
        }

        // ══════════════════════════════════════════════════════════════
        // TAHAP 5: SIMPAN FILE KREDENSIAL
        // ══════════════════════════════════════════════════════════════
        $this->command->info('📄 Menyimpan file kredensial...');
        $this->saveCredentialsFile($credentials);

        $this->command->info('');
        $this->command->info('✅ ══════════════════════════════════════════════════');
        $this->command->info('✅  SEEDING SELESAI!');
        $this->command->info('✅  - 70 Vendor (10 per kategori, semua belum terverifikasi)');
        $this->command->info('✅  - Logo, banner_image & cover_image: URL Unsplash per kategori');
        $this->command->info('✅  - 15 Pelanggan (tanpa riwayat transaksi)');
        $this->command->info('✅  - File kredensial: storage/app/credentials_akun.txt');
        $this->command->info('✅ ══════════════════════════════════════════════════');
    }

    private function saveCredentialsFile(array $credentials): void
    {
        $lines = [];
        $lines[] = str_repeat('=', 80);
        $lines[] = '  DAFTAR AKUN SISTEM EVENTVENDOR - DATA DUMMY';
        $lines[] = '  Dibuat otomatis oleh VendorAndCustomerSeeder';
        $lines[] = '  Tanggal: ' . now()->format('d F Y H:i:s') . ' WIB';
        $lines[] = str_repeat('=', 80);
        $lines[] = '';
        $lines[] = '  CATATAN KEAMANAN:';
        $lines[] = '  - Password di bawah adalah password PLAIN TEXT untuk keperluan testing';
        $lines[] = '  - Di dalam database, semua password sudah terenkripsi menggunakan bcrypt';
        $lines[] = '  - Simpan file ini dengan aman dan jangan bagikan sembarangan';
        $lines[] = '';

        $currentType     = '';
        $currentCategory = '';

        foreach ($credentials as $cred) {
            if ($cred['type'] !== $currentType) {
                $lines[]         = '';
                $lines[]         = str_repeat('-', 80);
                $lines[]         = "  AKUN {$cred['type']}";
                $lines[]         = str_repeat('-', 80);
                $currentType     = $cred['type'];
                $currentCategory = '';
            }

            if ($cred['type'] === 'VENDOR' && $cred['category'] !== $currentCategory) {
                $lines[]         = '';
                $lines[]         = "  [ Kategori: {$cred['category']} ]";
                $lines[]         = '';
                $currentCategory = $cred['category'];
            }

            if ($cred['type'] === 'VENDOR') {
                $lines[] = "  Nama Pemilik  : {$cred['name']}";
                $lines[] = "  Nama Bisnis   : {$cred['bisnis']}";
                $lines[] = "  Email         : {$cred['email']}";
                $lines[] = "  Password      : {$cred['password']}";
                $lines[] = "  Status        : Belum Terverifikasi (perlu persetujuan Admin)";
                $lines[] = '';
            } else {
                $lines[] = "  Nama          : {$cred['name']}";
                $lines[] = "  Email         : {$cred['email']}";
                $lines[] = "  Password      : {$cred['password']}";
                $lines[] = '';
            }
        }

        $lines[] = str_repeat('=', 80);
        $lines[] = '  AKUN ADMIN SISTEM';
        $lines[] = str_repeat('-', 80);
        $lines[] = '  (Cek file DatabaseSeeder.php atau akun yang sudah ada di database)';
        $lines[] = str_repeat('=', 80);

        $content = implode("\n", $lines);
        $path    = storage_path('app/credentials_akun.txt');
        file_put_contents($path, $content);
    }
}
