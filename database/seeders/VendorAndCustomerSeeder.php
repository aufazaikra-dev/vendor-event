<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VendorAndCustomerSeeder extends Seeder
{
    public function run(): void
    {
        // ══════════════════════════════════════════════════════════════
        // TAHAP 1: HAPUS SEMUA DATA LAMA (Kecuali Admin & Kategori & Kota)
        // ══════════════════════════════════════════════════════════════
        $this->command->info('🗑️  Menghapus data lama...');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus data transaksi dan ulasan terlebih dahulu (child tables)
        DB::table('reviews')->truncate();
        DB::table('transactions')->truncate();
        // Hapus data vendor beserta relasi
        DB::table('projects')->truncate();
        DB::table('pricelists')->truncate();
        DB::table('vendor_addresses')->truncate();
        DB::table('vendors')->truncate();
        // Hapus user (vendor + pelanggan), kecuali admin
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
        // Pastikan semua 6 kategori ada
        $catNames = ['Katering', 'Dekorasi', 'Makeup Artist (MUA)', 'Fotografer', 'Hiburan (Band/DJ)', 'MC'];
        foreach ($catNames as $catName) {
            if (!isset($categories[$catName])) {
                $newId = DB::table('categories')->insertGetId([
                    'name' => $catName,
                    'slug' => Str::slug($catName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $categories[$catName] = $newId;
            }
        }

        // ══════════════════════════════════════════════════════════════
        // TAHAP 3: DATA VENDOR PER KATEGORI
        // ══════════════════════════════════════════════════════════════

        // Data alamat khas Banda Aceh (9 kecamatan)
        $addresses = [
            ['jalan' => 'Jl. Teuku Umar No. 12', 'desa' => 'Peunayong', 'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Pocut Baren No. 5', 'desa' => 'Keuramat', 'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Sultan Alaidin Mahmudsyah No. 8', 'desa' => 'Ateuk Deah Tengoh', 'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Sri Ratu Safiatuddin No. 17', 'desa' => 'Neusu Aceh', 'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Tgk. Daud Beureueh No. 33', 'desa' => 'Sukaramai', 'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Syiah Kuala No. 22', 'desa' => 'Rukoh', 'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Lingkar Kampus No. 10', 'desa' => 'Kopelma Darussalam', 'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Prof. Doktor Ali Hasjmy No. 4', 'desa' => 'Beurawe', 'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Haji Mohd Hasan No. 7', 'desa' => 'Cot Mesjid', 'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Prada Utama No. 29', 'desa' => 'Prada', 'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Mujahidin No. 15', 'desa' => 'Surien', 'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Cut Nyak Dhien No. 3', 'desa' => 'Lambhuk', 'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Iskandar Muda No. 88', 'desa' => 'Emperom', 'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Tgk. Hamzah Fansuri No. 6', 'desa' => 'Lampuuk', 'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Batoh No. 44', 'desa' => 'Batoh', 'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Imam Bonjol No. 11', 'desa' => 'Lamjame', 'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Elang No. 9', 'desa' => 'Lampulo', 'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Tgk. Chik Ditiro No. 21', 'desa' => 'Laksana', 'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Kuta Raja No. 2', 'desa' => 'Peulanggahan', 'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Panglima Polim No. 14', 'desa' => 'Merduati', 'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Ahmad Yani No. 40', 'desa' => 'Geuceu Iniem', 'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Garot No. 19', 'desa' => 'Lamlagang', 'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Tgk. Imum Lueng Bata No. 31', 'desa' => 'Batoh', 'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Jurong Raya No. 16', 'desa' => 'Blang Cut', 'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Cot Murong No. 25', 'desa' => 'Cot Murong', 'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Ulee Lheu No. 53', 'desa' => 'Ulee Lheu', 'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Banda Aceh - Calang No. 47', 'desa' => 'Cot Lamkuweueh', 'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Teuku Nyak Arief No. 99', 'desa' => 'Darussalam', 'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Inong Balee No. 36', 'desa' => 'Lam Ara', 'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Kebun Raja No. 27', 'desa' => 'Lam Lagang', 'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Tgk. Di Bitai No. 18', 'desa' => 'Bitai', 'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Lamprit No. 62', 'desa' => 'Lamprit', 'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Makam Pahlawan No. 8', 'desa' => 'Lueng Bata', 'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Soekarno Hatta No. 77', 'desa' => 'Punge Jurong', 'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Tgk. Syik Kuala No. 5', 'desa' => 'Doy', 'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Keramat No. 43', 'desa' => 'Keramat', 'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Ahmad Dahlan No. 9', 'desa' => 'Peuniti', 'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Pahlawan No. 67', 'desa' => 'Setui', 'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Gp. Jawa No. 34', 'desa' => 'Gp. Jawa', 'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Ulee Kareng No. 56', 'desa' => 'Ie Masen Ulee Kareng', 'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Tibang No. 3', 'desa' => 'Tibang', 'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Deah Raya No. 11', 'desa' => 'Deah Raya', 'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Ajun No. 22', 'desa' => 'Ajun', 'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Tengku Di Anjong No. 15', 'desa' => 'Kampung Baru', 'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Lamgugob No. 39', 'desa' => 'Lamgugob', 'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Blang Oi No. 28', 'desa' => 'Blang Oi', 'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Laksana No. 71', 'desa' => 'Laksana', 'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Lambaro Skep No. 13', 'desa' => 'Lambaro Skep', 'kecamatan' => 'Kuta Alam'],
            ['jalan' => 'Jl. Rukoh Utama No. 6', 'desa' => 'Rukoh', 'kecamatan' => 'Syiah Kuala'],
            ['jalan' => 'Jl. Punge Blang Cut No. 20', 'desa' => 'Punge Blang Cut', 'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Geuceu Komplek No. 55', 'desa' => 'Geuceu Komplek', 'kecamatan' => 'Banda Raya'],
            ['jalan' => 'Jl. Lambhuk Raya No. 17', 'desa' => 'Lambhuk', 'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Meraxa Raya No. 32', 'desa' => 'Gp. Mulia', 'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. Kebun Raya No. 48', 'desa' => 'Keudah', 'kecamatan' => 'Kuta Raja'],
            ['jalan' => 'Jl. Garot Baru No. 7', 'desa' => 'Lamdom', 'kecamatan' => 'Lueng Bata'],
            ['jalan' => 'Jl. Tanjung No. 26', 'desa' => 'Lamteumen Barat', 'kecamatan' => 'Jaya Baru'],
            ['jalan' => 'Jl. Abu Bakar Ash Shiddiq No. 41', 'desa' => 'Ceurih', 'kecamatan' => 'Ulee Kareng'],
            ['jalan' => 'Jl. Hamzah No. 13', 'desa' => 'Punge Jurong', 'kecamatan' => 'Meuraxa'],
            ['jalan' => 'Jl. T. Nyak Makam No. 8', 'desa' => 'Seutui', 'kecamatan' => 'Baiturrahman'],
            ['jalan' => 'Jl. Kp. Mulia No. 49', 'desa' => 'Gampong Mulia', 'kecamatan' => 'Kuta Alam'],
        ];

        // ──────────────────────────────────────────────────────────────
        // DEFINISI DATA VENDOR PER KATEGORI
        // ──────────────────────────────────────────────────────────────
        $vendorsData = [

            'Katering' => [
                ['name' => 'Hidayah Catering', 'bisnis' => 'Hidayah Catering Banda Aceh', 'slug' => 'hidayah-catering', 'wa' => '6281234560001', 'singkat' => 'Katering halal premium khas Aceh untuk berbagai acara spesial Anda.', 'tentang' => 'Hidayah Catering hadir sejak 2015, menyajikan masakan khas Aceh dengan cita rasa autentik dan bahan-bahan segar pilihan. Kami melayani pernikahan, sunatan, dan berbagai acara korporat di seluruh Banda Aceh dengan kapasitas hingga 2.000 pax.', 'paket' => [['Paket Walimah', 3500000, '500 pax, menu 5 jenis lauk, prasmanan, set up 3 jam'], ['Paket Khitan', 2000000, '200 pax, menu lengkap, prasmanan, termasuk dekorasi meja']], 'proyek' => [['Walimah Keluarga Harun', '2024-03-15'], ['Syukuran Kelulusan SMAN 2', '2024-05-20'], ['Aqiqah Keluarga Daud', '2024-07-10']]],
                ['name' => 'Siti Katering', 'bisnis' => 'Siti Katering & Event Aceh', 'slug' => 'siti-katering-aceh', 'wa' => '6281234560002', 'singkat' => 'Spesialis katering acara pernikahan besar dan MICE se-Banda Aceh.', 'tentang' => 'Siti Katering telah dipercaya menangani lebih dari 500 acara pernikahan besar di Banda Aceh. Kami menghadirkan rasa yang konsisten dengan standar kebersihan terjamin dan tim profesional berpengalaman.', 'paket' => [['Paket Grand Wedding', 8500000, '1000 pax, menu 8 jenis lauk, dekorasi meja, pelayan terlatih'], ['Paket Maulid Akbar', 4500000, '500 pax, menu khas Aceh, minuman segar, sound system']], 'proyek' => [['Pernikahan Zulfa & Rafi', '2024-02-10'], ['Walimah Akbar BPMA', '2024-04-22'], ['Maulid Masjid Al-Ikhlas', '2024-09-05']]],
                ['name' => 'Warung Aceh Sari Rasa', 'bisnis' => 'Sari Rasa Katering Aceh', 'slug' => 'sari-rasa-katering', 'wa' => '6281234560003', 'singkat' => 'Hadirkan cita rasa masakan Aceh asli untuk setiap piring tamu Anda.', 'tentang' => 'Sari Rasa Katering mengutamakan penggunaan rempah asli Aceh dalam setiap masakan. Kami menyediakan layanan katering box dan prasmanan untuk acara keluarga, rapat kantor, hingga seminar.', 'paket' => [['Paket Nasi Box Premium', 850000, '100 box, nasi + lauk 3 jenis + buah + air mineral'], ['Paket Prasmanan Keluarga', 1800000, '200 pax, menu 4 jenis lauk khas Aceh, minuman']], 'proyek' => [['Rapat Dinas Pemerintah Aceh', '2024-01-18'], ['Wisuda Unsyiah Batch 3', '2024-06-30'], ['Sunatan Massal Puskesmas Ulee Kareng', '2024-08-12']]],
                ['name' => 'Dapur Khadijah Catering', 'bisnis' => 'Dapur Khadijah Catering Halal', 'slug' => 'dapur-khadijah', 'wa' => '6281234560004', 'singkat' => 'Katering halal bersertifikat, dipercaya ratusan keluarga Aceh.', 'tentang' => 'Dapur Khadijah adalah katering halal bersertifikat MUI Aceh. Kami berkomitmen menyajikan makanan higienis, lezat, dan tepat waktu. Melayani dari 50 hingga 3.000 porsi untuk berbagai jenis acara.', 'paket' => [['Paket Aqiqah Amanah', 2500000, '250 pax, menu kambing guling + lauk pelengkap, prasmanan'], ['Paket Ulang Tahun Kantor', 1200000, '150 pax, nasi box + snack + minuman']], 'proyek' => [['Aqiqah Bayi Famili Bu Rahma', '2024-03-28'], ['HUT PT Aceh Power', '2024-07-05'], ['Peresmian Gedung BPJPH Aceh', '2024-10-15']]],
                ['name' => 'Fatimah Food & Catering', 'bisnis' => 'Fatimah Food Catering Aceh', 'slug' => 'fatimah-food-catering', 'wa' => '6281234560005', 'singkat' => 'Sajian lengkap mulai nasi box, prasmanan, hingga katering harian.', 'tentang' => 'Fatimah Food melayani kebutuhan katering harian untuk perkantoran dan perumahan, serta katering event spesial. Dengan chef berpengalaman dan armada pengiriman sendiri, kami menjamin ketepatan waktu dan kualitas rasa.', 'paket' => [['Paket Katering Harian', 45000, 'Per orang/hari, menu berganti setiap hari, antar ke lokasi'], ['Paket Walimah Sederhana', 1500000, '150 pax, menu 4 lauk, prasmanan, taplak meja']], 'proyek' => [['Katering Harian RS Zainoel Abidin', '2024-05-01'], ['Walimah Sederhana Keluarga Bustami', '2024-06-14'], ['Makan Siang Seminar Perda', '2024-09-22']]],
                ['name' => 'Raja Katering Aceh', 'bisnis' => 'Raja Katering & Prasmanan Aceh', 'slug' => 'raja-katering-aceh', 'wa' => '6281234560006', 'singkat' => 'Katering terbaik untuk pesta pernikahan mewah di Banda Aceh.', 'tentang' => 'Raja Katering adalah pilihan utama keluarga kelas menengah atas di Banda Aceh. Kami menyediakan paket lengkap mulai dari makanan, dekorasi meja makan, pelayan berseragam, hingga peralatan makan berkualitas.', 'paket' => [['Paket Royal Wedding Dinner', 15000000, '1000 pax, menu fine dining, pelayan 20 orang, dekorasi premium'], ['Paket Corporate Lunch', 3000000, '200 pax, buffet internasional, minuman, dessert']], 'proyek' => [['Resepsi Pernikahan Putri Bupati Aceh Besar', '2024-01-25'], ['Gala Dinner Peringatan HUT Aceh', '2024-04-11'], ['Makan Malam Pertemuan Forum Rektor Indonesia', '2024-11-07']]],
                ['name' => 'Saifan Katering & Produksi', 'bisnis' => 'Saifan Katering Profesional', 'slug' => 'saifan-katering', 'wa' => '6281234560007', 'singkat' => 'Katering profesional dengan tim masak bersertifikat untuk acara Anda.', 'tentang' => 'Saifan Katering menggabungkan keahlian memasak tradisional Aceh dengan teknik modern. Kami memiliki dapur produksi berstandar food safety dan melayani pesanan mulai dari 100 hingga 5.000 porsi.', 'paket' => [['Paket Pesta Khitan Lengkap', 5000000, '500 pax, menu kambing + ayam, prasmanan, kursi & meja'], ['Paket Seminar & Workshop', 750000, '80 pax, coffee break, makan siang, snack sore']], 'proyek' => [['Khitanan Putra Pak Dirjen', '2024-02-20'], ['Workshop Wirausaha Muda Aceh', '2024-07-18'], ['Acara Haul Tgk. Di Blang', '2024-08-01']]],
                ['name' => 'Raudhah Catering Halal', 'bisnis' => 'Raudhah Catering & Snack Box', 'slug' => 'raudhah-catering', 'wa' => '6281234560008', 'singkat' => 'Spesialis snack box dan katering mini untuk acara formal dan informal.', 'tentang' => 'Raudhah Catering berspecialisasi dalam penyediaan snack box premium dan paket katering skala kecil hingga menengah. Cocok untuk rapat instansi, arisan, dan pesta ulang tahun dengan harga terjangkau.', 'paket' => [['Paket Snack Box Premium', 35000, 'Per box, 5 jenis kue basah + minuman kemasan'], ['Paket Arisan & Pengajian', 600000, '60 pax, nasi + lauk 2 jenis + snack + minuman']], 'proyek' => [['Rapat Anggaran DPRK Banda Aceh', '2024-03-10'], ['Arisan Ibu PKK Kecamatan Ulee Kareng', '2024-05-05'], ['Peringatan Isra Miraj Masjid Baiturrahman', '2024-07-28']]],
                ['name' => 'Mulia Katering & Dekorasi', 'bisnis' => 'Mulia Katering Banda Aceh', 'slug' => 'mulia-katering-bandaaceh', 'wa' => '6281234560009', 'singkat' => 'Paket all-in katering + dekorasi untuk pernikahan impian Anda.', 'tentang' => 'Mulia Katering hadir dengan konsep one-stop-solution: katering lengkap plus dekorasi pelaminan dan tenda. Kami memiliki armada lengkap dan tim 30 orang untuk memastikan acara Anda berjalan sempurna dari awal hingga akhir.', 'paket' => [['Paket All-In Nikah Bahagia', 12000000, '500 pax, katering + dekorasi + tenda + sound + MC'], ['Paket Syukuran Rumah Baru', 2200000, '200 pax, katering prasmanan + dekorasi meja tamu']], 'proyek' => [['Resepsi All-In Keluarga Zulkarnaen', '2024-02-03'], ['Walimah + Dekorasi Bu Hj. Mardiana', '2024-06-07'], ['Syukuran Kantor Dinas Pendidikan Aceh', '2024-10-22']]],
                ['name' => 'Berkah Katering Sejahtera', 'bisnis' => 'Berkah Katering & Nasi Kotak Aceh', 'slug' => 'berkah-katering-sejahtera', 'wa' => '6281234560010', 'singkat' => 'Katering berkualitas dengan harga bersahabat untuk semua lapisan masyarakat.', 'tentang' => 'Berkah Katering didirikan dengan misi menyediakan makanan sehat, lezat, dan berkah untuk semua kalangan. Kami melayani pesanan nasi kotak mulai 50 porsi dan prasmanan mulai 100 pax dengan harga sangat kompetitif.', 'paket' => [['Paket Nasi Kotak Berkah', 30000, 'Per box, nasi + ayam/ikan + sayur + kerupuk + air'], ['Paket Walimah Berkah', 1000000, '100 pax, menu halal lengkap, prasmanan sederhana']], 'proyek' => [['Pengajian Rutin RT 05 Ulee Kareng', '2024-04-15'], ['Khatam Al-Quran Dayah Darul Aman', '2024-06-25'], ['Makan Siang Pesantren Ramadhan SMK 1', '2024-03-20']]],
            ],

            'Dekorasi' => [
                ['name' => 'Elsa Dekorasi Wedding', 'bisnis' => 'Elsa Wedding Dekorasi Aceh', 'slug' => 'elsa-wedding-dekorasi', 'wa' => '6281234561001', 'singkat' => 'Dekorasi pernikahan mewah dengan sentuhan modern dan Islami.', 'tentang' => 'Elsa Wedding Dekorasi spesialis dalam dekorasi pernikahan bernuansa islami yang mewah dan elegan. Tim desainer kami yang berpengalaman siap mewujudkan konsep impian Anda dengan anggaran yang fleksibel.', 'paket' => [['Paket Dekorasi Islami Elegan', 7000000, 'Dekorasi pelaminan, lorong, meja tamu, backdrop foto'], ['Paket Dekorasi Garden Party', 5000000, 'Dekorasi outdoor, arkade bunga, meja tamu, pencahayaan']], 'proyek' => [['Pernikahan Sari & Andi - Nuansa Gold', '2024-01-20'], ['Walimah Outdoor Keluarga Hasbi', '2024-04-08'], ['Akad Nikah Ballroom Hotel Hermes', '2024-07-14']]],
                ['name' => 'Indah Dekorasi Nusantara', 'bisnis' => 'Indah Dekorasi & Event Aceh', 'slug' => 'indah-dekorasi-nusantara', 'wa' => '6281234561002', 'singkat' => 'Kreasi dekorasi acara bernuansa nusantara dengan motif Aceh yang khas.', 'tentang' => 'Indah Dekorasi menghadirkan keindahan budaya Aceh dalam setiap dekorasi. Kami menggunakan elemen kain songket, ukiran khas Aceh, dan bunga segar lokal untuk menciptakan nuansa pernikahan yang autentik dan menawan.', 'paket' => [['Paket Adat Aceh Sempurna', 8500000, 'Dekorasi pelaminan adat Aceh, busana pengantin, lengkap'], ['Paket Modern Minimalist', 4000000, 'Dekorasi clean minimalis, dekor meja, backdrop']], 'proyek' => [['Pernikahan Adat Keluarga Teuku Amin', '2024-02-17'], ['Khitanan Adat Keluarga Leube', '2024-05-30'], ['Resepsi Balairung Adat Aceh', '2024-08-24']]],
                ['name' => 'Zahra Dekorasi & Bunga', 'bisnis' => 'Zahra Dekorasi & Rangkaian Bunga', 'slug' => 'zahra-dekorasi-bunga', 'wa' => '6281234561003', 'singkat' => 'Spesialis rangkaian bunga segar dan dekorasi floral untuk pernikahan.', 'tentang' => 'Zahra Dekorasi menghadirkan keindahan bunga segar dalam setiap sentuhan dekorasi. Kami bekerja sama dengan pemasok bunga lokal terpercaya dan menyediakan layanan desain floral yang dapat disesuaikan dengan tema acara Anda.', 'paket' => [['Paket Full Floral Wedding', 9000000, 'Dekorasi bunga segar, bouquet pengantin, meja tamu, pelaminan'], ['Paket Floral Minimalist', 3500000, 'Dekorasi bunga pilihan untuk pelaminan dan foto area']], 'proyek' => [['Pernikahan Bunga Segar Tema Rose Garden', '2024-03-05'], ['Reuni Akbar SMAN 3 Banda Aceh', '2024-06-10'], ['Peluncuran Produk Kosmetik Aceh', '2024-09-18']]],
                ['name' => 'Azzam Event & Dekorasi', 'bisnis' => 'Azzam Event Organizer & Dekorasi', 'slug' => 'azzam-event-dekorasi', 'wa' => '6281234561004', 'singkat' => 'Event organizer plus dekorasi untuk semua jenis acara besar dan kecil.', 'tentang' => 'Azzam Event menyediakan layanan lengkap event organizer dan dekorasi. Dari pesta ulang tahun kecil-kecilan hingga acara korporat berskala besar, tim profesional kami siap menangani semuanya dengan detil dan penuh perhatian.', 'paket' => [['Paket EO + Dekorasi Pernikahan', 20000000, 'MC, sound, dekorasi, katering koordinasi, dokumentasi'], ['Paket EO Ulang Tahun Mewah', 8000000, 'Dekorasi, sound, hiburan, katering, MC, dokumentasi']], 'proyek' => [['Ulang Tahun Silver Keluarga Zaidin', '2024-01-30'], ['Pelantikan Rektor Unsyiah', '2024-03-14'], ['Walimah + EO Lengkap Bu Hj. Ismiati', '2024-08-09']]],
                ['name' => 'Cantik Dekorasi Pernikahan', 'bisnis' => 'Cantik Dekorasi Aceh', 'slug' => 'cantik-dekorasi-aceh', 'wa' => '6281234561005', 'singkat' => 'Dekorasi cantik dan estetik untuk hari bahagia yang tak terlupakan.', 'tentang' => 'Cantik Dekorasi hadir untuk menjadikan setiap momen pernikahan Anda terasa sempurna. Dengan portofolio lebih dari 300 acara, kami ahli dalam mengeksekusi berbagai tema dari rustic, bohemian, modern, hingga tradisional Aceh.', 'paket' => [['Paket Bohemian Chic', 6500000, 'Dekorasi pelaminan, lorong, foto area, tenda'], ['Paket Rustic Garden', 4500000, 'Dekorasi outdoor tema rustic, meja foto, backdrop']], 'proyek' => [['Pernikahan Tema Bohemian Mira & Faiz', '2024-04-12'], ['Foto Pre-Wedding Outdoor Couple Aceh', '2024-06-22'], ['Pesta Kelulusan SMA Tema Garden Party', '2024-07-20']]],
                ['name' => 'Harmoni Dekorasi & EO', 'bisnis' => 'Harmoni Dekorasi Aceh', 'slug' => 'harmoni-dekorasi-eo', 'wa' => '6281234561006', 'singkat' => 'Dekorasi harmonis yang menyatukan tradisi Aceh dan sentuhan modern.', 'tentang' => 'Harmoni Dekorasi berkomitmen menciptakan keseimbangan indah antara nilai adat Aceh dan desain kontemporer. Setiap detail dekorasi kami rancang dengan penuh kasih sayang dan profesionalitas.', 'paket' => [['Paket Harmoni Pernikahan', 7500000, 'Dekorasi pelaminan, lorong, foto corner, meja tamu VIP'], ['Paket Majlis Aqad Nikah', 3000000, 'Dekorasi aqad nikah, karpet merah, backdrop']], 'proyek' => [['Aqad & Resepsi Keluarga Amiruddin', '2024-02-28'], ['Dekorasi Wisuda Poltekes Aceh', '2024-05-15'], ['Reuni Akbar Alumni Unsyiah Angkatan 99', '2024-10-05']]],
                ['name' => 'Sinar Dekorasi Profesional', 'bisnis' => 'Sinar Dekorasi & Tenda Aceh', 'slug' => 'sinar-dekorasi-tenda', 'wa' => '6281234561007', 'singkat' => 'Penyedia tenda pesta dan dekorasi lengkap untuk outdoor dan indoor.', 'tentang' => 'Sinar Dekorasi menyediakan berbagai pilihan tenda pesta berkualitas tinggi dari kapasitas 100 hingga 3.000 pax. Dikombinasikan dengan dekorasi indah, kami menjamin acara outdoor Anda tetap nyaman dan menawan meski cuaca tidak bersahabat.', 'paket' => [['Paket Tenda + Dekorasi Outdoor', 10000000, 'Tenda 500 pax, dekorasi, sound, lighting, kursi meja'], ['Paket Tenda Mini Keluarga', 2500000, 'Tenda 100 pax, kursi meja, lighting sederhana']], 'proyek' => [['Pesta Pernikahan Outdoor Kp. Mulia', '2024-03-22'], ['Acara HUT RI Kecamatan Syiah Kuala', '2024-08-17'], ['Open House Lebaran Keluarga Direktur BPKD', '2024-04-20']]],
                ['name' => 'Bunga Hati Dekorasi', 'bisnis' => 'Bunga Hati Wedding Decoration', 'slug' => 'bunga-hati-dekorasi', 'wa' => '6281234561008', 'singkat' => 'Dekorasi pernikahan dengan tema bunga yang romantis dan berkesan.', 'tentang' => 'Bunga Hati Dekorasi mengkhususkan diri pada dekorasi bertemakan bunga dan alam. Kami percaya bahwa setiap pernikahan harus memancarkan keindahan alam yang tulus, dan kami hadir untuk mewujudkannya dengan harga yang terjangkau.', 'paket' => [['Paket Romantic Flower Full', 8000000, 'Full dekorasi bunga segar, pelaminan, foto area, meja'], ['Paket Simple Elegant', 3000000, 'Dekorasi minimalis elegan, pelaminan + backdrop']], 'proyek' => [['Pernikahan Tema Floral Romantis Nia & Arif', '2024-01-14'], ['Photo Booth Wisuda Universitas Syiah Kuala', '2024-06-05'], ['Dekorasi Pesta Tunangan Dewi', '2024-07-30']]],
                ['name' => 'Mahkota Dekorasi & Event', 'bisnis' => 'Mahkota Dekorasi Pernikahan Aceh', 'slug' => 'mahkota-dekorasi-event', 'wa' => '6281234561009', 'singkat' => 'Dekorasi pernikahan premium bagaikan mahkota untuk hari bahagia Anda.', 'tentang' => 'Mahkota Dekorasi menghadirkan nuansa kemewahan yang sesungguhnya dalam setiap acara. Kami menggunakan bahan-bahan berkualitas tinggi, kristal, dan bunga impor pilihan untuk menciptakan dekorasi yang tak tertandingi di Banda Aceh.', 'paket' => [['Paket Mahkota Agung Premium', 25000000, 'Dekorasi mewah, bunga impor, kristal, full coverage venue'], ['Paket Grand Elegance', 15000000, 'Dekorasi premium, pelaminan mewah, lorong, foto area VIP']], 'proyek' => [['Wedding Mewah di Hermes Palace Hotel', '2024-02-14'], ['Gala Dinner Gubernur Aceh', '2024-04-02'], ['Pernikahan Anak Tokoh Adat Aceh', '2024-09-07']]],
                ['name' => 'Ananda Dekorasi Kreatif', 'bisnis' => 'Ananda Kreatif Dekorasi Aceh', 'slug' => 'ananda-dekorasi-kreatif', 'wa' => '6281234561010', 'singkat' => 'Dekorasi kreatif dan unik dengan konsep yang belum pernah ada sebelumnya.', 'tentang' => 'Ananda Dekorasi hadir untuk Anda yang menginginkan konsep berbeda dan tidak biasa. Tim kreatif kami siap merancang dekorasi tematik yang benar-benar personal dan mencerminkan kepribadian Anda dan pasangan.', 'paket' => [['Paket Konsep Unik Custom', 12000000, 'Desain dan eksekusi konsep custom, full venue'], ['Paket Tema Dongeng Romantis', 9000000, 'Dekorasi tema dongeng, lighting dramatis, props lengkap']], 'proyek' => [['Wedding Tema Starry Night Indah & Ridha', '2024-05-25'], ['Ulang Tahun Tema Petualangan Anak TK', '2024-07-01'], ['Pesta Ulang Tahun Dewasa Tema 90s', '2024-09-29']]],
            ],

            'Makeup Artist (MUA)' => [
                ['name' => 'Riska Makeup Artist', 'bisnis' => 'Riska MUA Bridal Aceh', 'slug' => 'riska-mua-bridal', 'wa' => '6281234562001', 'singkat' => 'Spesialis makeup pengantin dengan hasil glowing alami tahan lama.', 'tentang' => 'Riska MUA telah merias lebih dari 800 pengantin cantik di Banda Aceh dan sekitarnya. Dengan keahlian dalam makeup modern dan tradisional Aceh, Riska menjamin Anda tampil percaya diri dan cantik sepanjang hari pernikahan.', 'paket' => [['Paket Bridal Full Day', 2500000, 'Makeup akad + resepsi, include false lashes, bawa ke venue'], ['Paket Makeup Modern Minimalist', 1200000, 'Makeup modern, 5 jam ketahanan, touch up kit']], 'proyek' => [['Pengantin Sari - Pernikahan Adat Aceh', '2024-01-20'], ['Rias Pengantin Muslimah Dian', '2024-04-15'], ['Makeup Wisuda Polmed Aceh', '2024-06-28']]],
                ['name' => 'Meutia Beauty Studio', 'bisnis' => 'Meutia Beauty & Bridal Studio', 'slug' => 'meutia-beauty-studio', 'wa' => '6281234562002', 'singkat' => 'Studio kecantikan profesional untuk pengantin dan acara formal.', 'tentang' => 'Meutia Beauty Studio adalah studio kecantikan modern di Banda Aceh yang menyediakan layanan makeup, penataan rambut, dan perawatan kulit pre-wedding. Dengan suasana salon yang nyaman dan tim MUA bersertifikat nasional.', 'paket' => [['Paket Studio Bridal Complete', 3500000, 'Makeup + hairdo, perawatan kulit 2x sesi, studio akad'], ['Paket Makeup Wisuda & Formal', 800000, 'Makeup formal 4 jam, free touch up powder']], 'proyek' => [['Studio Shoot Pengantin Mutia & Rizal', '2024-02-10'], ['Makeup Resepsi Anak Pejabat Dinas Aceh', '2024-05-20'], ['Foto Pre-Wedding Couple Banda Aceh', '2024-08-10']]],
                ['name' => 'Ayu Sari MUA Profesional', 'bisnis' => 'Ayu Sari MUA & Hairdo', 'slug' => 'ayu-sari-mua', 'wa' => '6281234562003', 'singkat' => 'Makeup artist profesional dengan spesialisasi hairdo dan sanggul adat.', 'tentang' => 'Ayu Sari MUA mengkhususkan diri dalam seni tata rias dan tata rambut tradisional Aceh. Dengan keahlian membuat sanggul adat, sirih dan tepung tawar, Ayu menjamin penampilan pengantin yang anggun dan berkesan.', 'paket' => [['Paket Rias Adat Aceh Penuh', 3000000, 'Makeup + sanggul adat + pakaian pengantin Aceh, full day'], ['Paket Rias Semi-Adat Modern', 1800000, 'Makeup modern mix tradisional, hairdo adat, 6 jam']], 'proyek' => [['Rias Pengantin Adat Aceh Fatimah & Siddiq', '2024-03-08'], ['Rias Penyambutan Tamu Kehormatan', '2024-06-17'], ['Tata Rias Penampilan Seni Budaya Aceh', '2024-09-14']]],
                ['name' => 'Nadia Glam Studio', 'bisnis' => 'Nadia Glam MUA Aceh', 'slug' => 'nadia-glam-studio', 'wa' => '6281234562004', 'singkat' => 'Tampil glam dan percaya diri dengan sentuhan makeup artis terbaik Aceh.', 'tentang' => 'Nadia Glam Studio mengutamakan teknik makeup yang menonjolkan kecantikan alami setiap klien. Dengan produk-produk premium internasional dan teknik airbrush, hasil makeup kami tahan dari pagi hingga malam hari.', 'paket' => [['Paket Airbrush Glam Bridal', 4000000, 'Makeup airbrush tahan 12 jam, hairdo modern, touch up'], ['Paket Evening Party Glamour', 1500000, 'Makeup glam untuk acara malam, 8 jam ketahanan']], 'proyek' => [['Red Carpet Look Rina di Acara Gala Dinner', '2024-01-28'], ['Makeup Pengantin Airbrush Nova & Hendra', '2024-04-30'], ['Rias Fashion Show Batik Aceh di Taman Budaya', '2024-07-15']]],
                ['name' => 'Dewi Cantik MUA', 'bisnis' => 'Dewi Cantik Makeup & Salon', 'slug' => 'dewi-cantik-mua', 'wa' => '6281234562005', 'singkat' => 'Salon kecantikan lengkap dengan layanan makeup dan perawatan rambut.', 'tentang' => 'Dewi Cantik hadir sebagai solusi kecantikan satu atap: makeup artist, salon rambut, dan perawatan kuku. Dengan pengalaman lebih dari 10 tahun, kami melayani klien untuk pernikahan, wisuda, foto formal, dan berbagai acara spesial.', 'paket' => [['Paket Wedding Full Service', 2800000, 'Makeup + creambath + hairdo + perawatan kuku, bridal full day'], ['Paket Wisuda Cantik', 650000, 'Makeup wisuda + hairdo + cream bath mini']], 'proyek' => [['Wisuda Mahasiswi Unsyiah Angkatan 2020', '2024-06-08'], ['Makeup Pernikahan Putri Ketua DPRA', '2024-03-25'], ['Beauty Shoot Model Produk Hijab Lokal', '2024-09-02']]],
                ['name' => 'Fitri Make Over Artist', 'bisnis' => 'Fitri Make Over Aceh', 'slug' => 'fitri-make-over', 'wa' => '6281234562006', 'singkat' => 'Make over total untuk penampilan memukau di hari istimewa Anda.', 'tentang' => 'Fitri Make Over Artist spesialis dalam transformasi total penampilan (make over). Kami tidak hanya mengerjakan makeup, tetapi juga konsultasi warna, pemilihan busana, dan aksesori untuk memastikan keseluruhan penampilan Anda sempurna.', 'paket' => [['Paket Make Over Total Bridal', 5000000, 'Konsultasi + makeup + busana + aksesori + foto'], ['Paket Make Over Prom Night', 1000000, 'Makeup pesta + hairdo + konsultasi busana']], 'proyek' => [['Total Make Over Pengantin Yanti & Rudi', '2024-02-22'], ['Prom Night SMA 5 Banda Aceh', '2024-05-10'], ['Peluncuran Brand Kosmetik Aceh Baru', '2024-11-03']]],
                ['name' => 'Lestari Beauty & Bridal', 'bisnis' => 'Lestari Beauty Bridal Aceh', 'slug' => 'lestari-beauty-bridal', 'wa' => '6281234562007', 'singkat' => 'Riasan elegan dan tahan lama untuk pengantin berkulit cerah dan gelap.', 'tentang' => 'Lestari Beauty spesialis makeup untuk semua jenis dan warna kulit. Kami memahami tantangan merias kulit tropis dan menggunakan teknik serta produk khusus untuk menghasilkan makeup tahan panas dan lembab yang sempurna.', 'paket' => [['Paket Bride Glow Full Coverage', 2200000, 'Makeup tahan cuaca, SPF protection, full day'], ['Paket Engagement/Tunangan', 900000, 'Makeup siang + hairdo simple, 5 jam']], 'proyek' => [['Pernikahan Outdoor Tema Pantai Siti & Adi', '2024-03-30'], ['Foto Lamaran Keluarga Syahputra', '2024-05-25'], ['Rias Pemain Drama Festival Seni Aceh', '2024-08-20']]],
                ['name' => 'Anisa Premium MUA', 'bisnis' => 'Anisa Premium MUA & Studio', 'slug' => 'anisa-premium-mua', 'wa' => '6281234562008', 'singkat' => 'MUA premium dengan teknik internasional untuk pengantin modern Aceh.', 'tentang' => 'Anisa Premium MUA menghadirkan teknik makeup kelas dunia ke Banda Aceh. Terlatih langsung di Jakarta dan Kuala Lumpur, Anisa menggabungkan tren makeup global dengan pemahaman mendalam tentang kecantikan lokal Aceh.', 'paket' => [['Paket Luxury Bridal Premiere', 7000000, 'Konsultasi 2x, makeup akad + resepsi, airbrush, full service'], ['Paket Foto Pre-Wedding Premium', 1500000, 'Makeup fotografi + hairdo editorial look']], 'proyek' => [['Pre-Wedding Shoot Internasional Couple', '2024-02-05'], ['Makeup Pengantin Putri Direktur Bank Aceh', '2024-06-15'], ['Fashion Show Final Desainer Aceh di JCC', '2024-10-18']]],
                ['name' => 'Zahwa MUA Natural Look', 'bisnis' => 'Zahwa Natural Beauty Aceh', 'slug' => 'zahwa-mua-natural', 'wa' => '6281234562009', 'singkat' => 'Makeup natural dan segar untuk tampilan pengantin yang cantik apa adanya.', 'tentang' => 'Zahwa MUA percaya pada kecantikan alami setiap wanita. Kami menggunakan produk halal bersertifikat dan teknik makeup yang menonjolkan fitur cantik asli Anda tanpa terlihat berlebihan, cocok untuk pengantin yang ingin tampil natural namun tetap memukau.', 'paket' => [['Paket Natural Bride Glow', 1800000, 'Makeup natural alami, produk halal, tahan 8 jam'], ['Paket Rias Aqiqah & Khitan', 500000, 'Riasan orang tua acara syukuran, 4 jam']], 'proyek' => [['Pernikahan Natural Look Hana & Fauzan', '2024-04-18'], ['Rias Mama Pengantin di Walimah Keluarga', '2024-07-08'], ['Makeup untuk Foto Profile Resmi Kepala Dinas', '2024-09-30']]],
                ['name' => 'Salsabila Beauty House', 'bisnis' => 'Salsabila Beauty House Aceh', 'slug' => 'salsabila-beauty-house', 'wa' => '6281234562010', 'singkat' => 'Rumah kecantikan lengkap: makeup, hair, nail, dan skincare terpadu.', 'tentang' => 'Salsabila Beauty House adalah rumah kecantikan komprehensif di Banda Aceh. Layanan kami mencakup makeup profesional, perawatan rambut, nail art, dan konsultasi skincare, semua dalam satu lokasi yang nyaman dan higienis.', 'paket' => [['Paket Queen for a Day Bridal', 4500000, 'Full spa + makeup + hairdo + nail art + foto'], ['Paket Pre-Wedding Skincare + Makeup', 1200000, 'Facial 2x sesi + makeup foto natural']], 'proyek' => [['Full Package Pengantin Rina & Bayu', '2024-01-12'], ['Perawatan Pre-Wedding Couple Keluarga Usman', '2024-03-15'], ['Makeup Artis Lokal untuk Video Klip Aceh', '2024-07-25']]],
            ],

            'Fotografer' => [
                ['name' => 'Aceh Lens Studio', 'bisnis' => 'Aceh Lens Photography Studio', 'slug' => 'aceh-lens-studio', 'wa' => '6281234563001', 'singkat' => 'Mengabadikan momen berharga dengan sudut pandang seni yang tinggi.', 'tentang' => 'Aceh Lens Studio adalah tim fotografer profesional yang berspesialisasi dalam fotografi pernikahan, portrait, dan dokumentasi acara. Dengan peralatan terkini dan gaya editing yang khas, setiap foto kami bercerita lebih dari seribu kata.', 'paket' => [['Paket Dokumentasi Wedding Full Day', 5000000, '2 fotografer, full day, 500 foto edited, album digital'], ['Paket Foto Keluarga Portrait', 1200000, '2 jam sesi, 30 foto edited, cetak 4R 10 lembar']], 'proyek' => [['Wedding Documentation Adnan & Putri', '2024-02-25'], ['Foto Keluarga Annual Keluarga Besar Syamsuddin', '2024-05-18'], ['Dokumentasi Wisuda Batch 2 Politeknik Aceh', '2024-06-30']]],
                ['name' => 'Hafiz Photography Wedding', 'bisnis' => 'Hafiz Wedding Photography Aceh', 'slug' => 'hafiz-wedding-photography', 'wa' => '6281234563002', 'singkat' => 'Ceritakan kisah cinta Anda dalam setiap bingkai foto yang bermakna.', 'tentang' => 'Hafiz Photography mengambil pendekatan storytelling dalam setiap karya fotografinya. Kami tidak hanya memotret momen, tetapi juga merasakan emosi dan menceritakannya melalui komposisi dan pencahayaan yang artistik. Spesialis pernikahan sejak 2016.', 'paket' => [['Paket Storytelling Wedding', 7500000, '2 fotografer + 1 videografer, full day, highlight film'], ['Paket Pre-Wedding Artistik', 2000000, 'Foto pre-wedding 3 jam, 50 foto edited, konsep artistik']], 'proyek' => [['Pre-Wedding Senja di Ulee Lheu Irma & Budi', '2024-03-10'], ['Wedding Story Film Pernikahan Eka & Hasan', '2024-05-04'], ['Dokumentasi Kelulusan SMAN 1 Banda Aceh', '2024-06-20']]],
                ['name' => 'Cahaya Foto Aceh', 'bisnis' => 'Cahaya Studio Foto Aceh', 'slug' => 'cahaya-foto-aceh', 'wa' => '6281234563003', 'singkat' => 'Studio foto professional dengan pencahayaan terbaik untuk semua kebutuhan.', 'tentang' => 'Cahaya Studio Foto adalah studio foto indoor professional di Banda Aceh. Dilengkapi dengan berbagai background, lighting profesional, dan printer foto berkualitas tinggi. Melayani sesi foto individual, keluarga, produk, dan corporate.', 'paket' => [['Paket Studio Foto Keluarga', 800000, '1,5 jam sesi, 5 background pilihan, 20 foto edited'], ['Paket Foto Produk UMKM', 500000, '50 foto produk, 2 jam sesi, retouching professional']], 'proyek' => [['Foto Produk UMKM Kopi Aceh Gayo', '2024-01-22'], ['Foto Studio Keluarga Besar Hari Raya', '2024-04-25'], ['Foto Profil Resmi Pejabat Pemerintah Aceh', '2024-08-05']]],
                ['name' => 'Drone Foto Aceh', 'bisnis' => 'Drone & Aerial Photography Aceh', 'slug' => 'drone-foto-aceh', 'wa' => '6281234563004', 'singkat' => 'Spesialis foto dan video aerial drone untuk acara dan kebutuhan komersial.', 'tentang' => 'Drone Foto Aceh adalah pionir dalam layanan fotografi dan videografi udara di Banda Aceh. Dengan drone DJI Mavic 3 Pro bersertifikat CAAS, kami menyediakan rekaman udara berkualitas cinema untuk acara pernikahan, pariwisata, dan kebutuhan korporat.', 'paket' => [['Paket Aerial Wedding Coverage', 3500000, 'Drone foto + video, 4 jam, highlight film, edited 4K'], ['Paket Pemetaan & Survey Udara', 5000000, 'Aerial mapping untuk lahan/properti, laporan ortofoto']], 'proyek' => [['Aerial Shot Pernikahan di Pantai Lhok Nga', '2024-03-20'], ['Pemetaan Kawasan Reklamasi Banda Aceh', '2024-07-12'], ['Video Promo Pariwisata Aceh 4K', '2024-10-01']]],
                ['name' => 'Nurul Foto Wedding', 'bisnis' => 'Nurul Foto & Video Aceh', 'slug' => 'nurul-foto-wedding', 'wa' => '6281234563005', 'singkat' => 'Layanan foto dan video pernikahan yang romantis dan penuh kenangan.', 'tentang' => 'Nurul Foto & Video hadir untuk mengabadikan setiap momen pernikahan Anda menjadi karya seni yang abadi. Tim kami terdiri dari fotografer dan videografer berpengalaman yang bekerja dengan harmonis untuk menghasilkan output terbaik.', 'paket' => [['Paket Photo + Video Wedding Full', 9000000, '2 fotografer + 2 videografer, teaser + full film, album'], ['Paket Hanya Foto Wedding', 4000000, '2 fotografer, full day, 300 foto edited, album digital']], 'proyek' => [['Photo & Cinematic Video Walimah Suheri', '2024-02-17'], ['Dokumentasi Khitanan Masal Desa Lamnyong', '2024-05-12'], ['Foto Prewedding Tema Pantai Romantis', '2024-08-15']]],
                ['name' => 'Momen Abadi Photography', 'bisnis' => 'Momen Abadi Photo Aceh', 'slug' => 'momen-abadi-photography', 'wa' => '6281234563006', 'singkat' => 'Mengabadikan setiap momen penting dalam sebuah karya fotografi yang bermakna.', 'tentang' => 'Momen Abadi Photography percaya bahwa foto yang baik adalah foto yang bisa membawa Anda kembali ke momen itu setiap kali melihatnya. Dengan pendekatan candid dan natural, kami menangkap emosi dan keceriaan sesungguhnya dari setiap acara.', 'paket' => [['Paket Candid Wedding Full Day', 4500000, '2 fotografer, pendekatan candid natural, full day, 400 foto'], ['Paket Foto Bayi & Newborn', 700000, 'Sesi newborn photography, 2 jam, 20 foto edited']], 'proyek' => [['Candid Wedding Fira & Reza - Tema Vintage', '2024-01-27'], ['Newborn Session Baby Zahra', '2024-04-10'], ['Dokumentasi Konser Amal Musik Aceh', '2024-09-12']]],
                ['name' => 'Kilau Foto & Film Aceh', 'bisnis' => 'Kilau Photography & Videography', 'slug' => 'kilau-foto-film', 'wa' => '6281234563007', 'singkat' => 'Foto dan film dokumentasi acara dengan hasil cinematic yang memukau.', 'tentang' => 'Kilau Foto & Film spesialis dalam pembuatan film dokumentasi pernikahan berkualitas sinematik. Setiap video yang kami produksi diedit dengan scoring musik yang tepat untuk menciptakan film pernikahan yang mengharukan dan berkelas.', 'paket' => [['Paket Cinematic Film Wedding', 12000000, '2 kameraman + drone, full film cinematic 15 menit, teaser'], ['Paket Teaser Film Wedding', 5000000, 'Cinematic teaser 3-5 menit, 1 hari syuting, scoring musik']], 'proyek' => [['Film Sinematik Pernikahan Indira & Yusuf', '2024-03-15'], ['Teaser Wedding Film yang Viral 200K Views', '2024-06-01'], ['Dokumentasi Film Anniversary 25 Tahun Pernikahan', '2024-11-20']]],
                ['name' => 'Foto Ceria Keluarga', 'bisnis' => 'Foto Ceria & Portrait Aceh', 'slug' => 'foto-ceria-keluarga', 'wa' => '6281234563008', 'singkat' => 'Sesi foto keluarga yang menyenangkan dan menghasilkan kenangan indah bersama.', 'tentang' => 'Foto Ceria mengkhususkan diri dalam sesi foto keluarga yang fun dan menyenangkan. Fotografer kami terampil berinteraksi dengan anak-anak dan anggota keluarga untuk menghasilkan foto-foto spontan yang natural dan penuh kebahagiaan.', 'paket' => [['Paket Family Fun Outdoor', 600000, '1,5 jam outdoor, 15 foto edited, lokasi pilihan'], ['Paket Foto Lebaran Keluarga', 1000000, '2 jam sesi, 30 foto edited, 2 lokasi outdoor/indoor']], 'proyek' => [['Foto Keluarga Besar Lebaran Idul Fitri', '2024-04-13'], ['Sesi Foto Ulang Tahun Anak Keluarga Ridwan', '2024-06-24'], ['Foto Keluarga Sambut Menantu Baru', '2024-09-20']]],
                ['name' => 'Vista Foto Profesional', 'bisnis' => 'Vista Photography Profesional Aceh', 'slug' => 'vista-foto-profesional', 'wa' => '6281234563009', 'singkat' => 'Fotografer korporat dan event profesional untuk instansi dan perusahaan.', 'tentang' => 'Vista Photography melayani kebutuhan fotografi korporat dan event profesional untuk instansi pemerintah, BUMN, dan perusahaan swasta di Banda Aceh dan sekitarnya. Hasil foto berstandar editorial dengan pengiriman cepat.', 'paket' => [['Paket Dokumentasi Event Korporat', 3000000, '1 fotografer, 8 jam, 100 foto edited, kirim 24 jam'], ['Paket Foto Profil Karyawan Massal', 1500000, 'Sesi foto profil professional untuk 20 orang']], 'proyek' => [['Foto Profil Massal Karyawan BPKP Aceh', '2024-02-08'], ['Dokumentasi Seminar Internasional di Unsyiah', '2024-05-22'], ['Foto Acara Pelantikan Pejabat Pemkot Aceh', '2024-08-30']]],
                ['name' => 'Selaras Foto & Video', 'bisnis' => 'Selaras Photography & Videography', 'slug' => 'selaras-foto-video', 'wa' => '6281234563010', 'singkat' => 'Paket foto dan video terlengkap dengan harga paling kompetitif di Banda Aceh.', 'tentang' => 'Selaras Foto & Video hadir untuk semua budget. Kami menawarkan layanan fotografi dan videografi berkualitas dengan harga yang sangat terjangkau. Tidak perlu mahal untuk mendapatkan foto dan video pernikahan yang indah dan berkesan.', 'paket' => [['Paket Hemat Foto + Video Wedding', 3000000, '1 fotografer + 1 videografer, 8 jam, 200 foto, video 5 mnt'], ['Paket Super Hemat Foto Saja', 1500000, '1 fotografer, 6 jam, 150 foto edited, album digital']], 'proyek' => [['Foto & Video Budget Friendly Keluarga Yusnidar', '2024-01-15'], ['Dokumentasi Nikahan di KUA Pernikahan Sederhana', '2024-04-05'], ['Foto Ulang Tahun Perusahaan ke-10', '2024-09-17']]],
            ],

            'Hiburan (Band/DJ)' => [
                ['name' => 'Gita Nusantara Band Aceh', 'bisnis' => 'Gita Nusantara Live Band', 'slug' => 'gita-nusantara-band', 'wa' => '6281234564001', 'singkat' => 'Band professional pembawa suasana hangat untuk pesta pernikahan Anda.', 'tentang' => 'Gita Nusantara adalah band live yang telah tampil di lebih dari 400 acara pernikahan di Banda Aceh. Dengan repertoire lagu yang luas (pop Indonesia, melayu, dangdut, dan hits internasional), kami menjamin suasana pesta tetap meriah hingga akhir acara.', 'paket' => [['Paket Band 4 Jam Wedding', 5000000, '5 personil + sound system, 4 jam tampil, lagu pilihan'], ['Paket Band 2 Jam Gathering', 2500000, '5 personil, 2 jam tampil, pilihan lagu unlimited']], 'proyek' => [['Live Band Resepsi Pernikahan Taufik & Suci', '2024-02-18'], ['Penampilan di Gala Dinner PT Pupuk Iskandar Muda', '2024-05-08'], ['Live Music HUT Kota Banda Aceh di Blang Padang', '2024-08-22']]],
                ['name' => 'DJ Blaze Aceh', 'bisnis' => 'DJ Blaze & Sound System Aceh', 'slug' => 'dj-blaze-aceh', 'wa' => '6281234564002', 'singkat' => 'DJ profesional dengan sound system premium untuk pesta yang tak terlupakan.', 'tentang' => 'DJ Blaze adalah salah satu DJ terbaik di Banda Aceh dengan pengalaman lebih dari 8 tahun. Mengkhususkan diri dalam EDM, pop, dan dangdut remix, DJ Blaze selalu berhasil membuat lantai dansa penuh dengan energi yang luar biasa.', 'paket' => [['Paket DJ Full Night Wedding', 4000000, 'DJ + sound system komplit, 6 jam, lighting basic'], ['Paket DJ Corporate Party', 6000000, 'DJ + sound system premium + LED wall + lighting show']], 'proyek' => [['After Party Resepsi Pernikahan Muda-Mudi', '2024-03-02'], ['DJ Night Corporate Gathering Bank Mandiri Aceh', '2024-06-28'], ['Festival Musik Pemuda Banda Aceh', '2024-08-10']]],
                ['name' => 'Serunai Orkestra Aceh', 'bisnis' => 'Serunai Orkestra & Musik Tradisional', 'slug' => 'serunai-orkestra-aceh', 'wa' => '6281234564003', 'singkat' => 'Kesenian musik tradisional Aceh yang memperindah setiap momen sakral.', 'tentang' => 'Serunai Orkestra menghadirkan keindahan musik tradisional Aceh seperti Rapai, Serunai, Biola Melayu, dan Tari Saman dalam berbagai acara pernikahan dan formal. Kami berkomitmen melestarikan seni budaya Aceh sambil memberikan penampilan yang memukau.', 'paket' => [['Paket Rapai & Tari Saman Wedding', 3500000, '12 personil, 2 jam penampilan, kostum lengkap'], ['Paket Pembukaan Adat Aceh Resmi', 5000000, 'Prosesi adat lengkap, musik tradisional, 3 jam']], 'proyek' => [['Pembukaan Adat Resepsi Pernikahan Keluarga Datuk', '2024-01-10'], ['Penampilan di Festival Budaya Aceh Tgk. Di Blang', '2024-04-07'], ['Tari Saman Penyambutan Tamu Kenegaraan', '2024-09-25']]],
                ['name' => 'Harmoni Music Entertainment', 'bisnis' => 'Harmoni Music & Entertainment Aceh', 'slug' => 'harmoni-music-aceh', 'wa' => '6281234564004', 'singkat' => 'Paket hiburan lengkap: band live, MC, dan dekorasi panggung untuk acara Anda.', 'tentang' => 'Harmoni Music Entertainment adalah penyedia hiburan komprehensif untuk acara pernikahan dan event korporat. Kami menyediakan band live, DJ, MC profesional, dan sound system berkualitas tinggi dalam satu paket yang sangat terjangkau.', 'paket' => [['Paket Hiburan Komplit Wedding', 12000000, 'Band + DJ + MC + sound + lighting + dekorasi panggung'], ['Paket Band + MC Saja', 6000000, 'Band 5 personil + MC profesional, 5 jam, sound system']], 'proyek' => [['Full Entertainment Package Walimah Surya & Maya', '2024-02-14'], ['Entertainment Night Gala Dinner PT Telkom Aceh', '2024-07-20'], ['Pentas Seni Hari Jadi Unsyiah ke-64', '2024-09-01']]],
                ['name' => 'Nada Indah Band Aceh', 'bisnis' => 'Nada Indah Live Band Aceh', 'slug' => 'nada-indah-band', 'wa' => '6281234564005', 'singkat' => 'Band melayu dan pop yang romantis untuk pernikahan bersuasana syahdu.', 'tentang' => 'Nada Indah Band mengkhususkan diri membawakan lagu-lagu melayu, pop romantis, dan lagu Aceh untuk menciptakan suasana pernikahan yang hangat dan berkesan. Vokalis berpengalaman kami dapat membawakan lagu-lagu permintaan tamu.', 'paket' => [['Paket Band Melayu Romantis', 3500000, '5 personil, repertoire melayu/pop, 3 jam tampil'], ['Paket Lagu Aceh Khusus', 2000000, 'Band + vokal khusus lagu Aceh, 2 jam']], 'proyek' => [['Band Pernikahan Melayu Adat Keluarga Jalaluddin', '2024-03-14'], ['Penampilan di Peringatan Hari Jadi Aceh', '2024-07-05'], ['Hiburan Malam Pertemuan Wali Kota se-Indonesia', '2024-10-28']]],
                ['name' => 'Raya Entertainment Aceh', 'bisnis' => 'Raya Entertainment & Event Aceh', 'slug' => 'raya-entertainment-aceh', 'wa' => '6281234564006', 'singkat' => 'Entertainment komplit: band, DJ, badut, sulap, dan hiburan anak untuk pesta.', 'tentang' => 'Raya Entertainment adalah penyedia hiburan terlengkap di Banda Aceh. Mulai dari band live dan DJ untuk dewasa, hingga badut, sulap, face painting, dan bouncy castle untuk anak-anak. Kami memastikan seluruh tamu, dari yang kecil hingga yang besar, terhibur.', 'paket' => [['Paket Pesta Anak Merdeka', 5000000, 'Badut + sulap + bouncy castle + face painting, 3 jam'], ['Paket Family Fun Party', 8000000, 'Band + badut + hiburan anak komplit, 5 jam']], 'proyek' => [['Pesta Ulang Tahun Anak Keluarga Keuchik', '2024-01-28'], ['Family Gathering PT PLN Aceh', '2024-04-21'], ['Festival Anak Islami Kecamatan Baiturrahman', '2024-07-30']]],
                ['name' => 'Eka Sound System Profesional', 'bisnis' => 'Eka Sound & Lighting Aceh', 'slug' => 'eka-sound-lighting', 'wa' => '6281234564007', 'singkat' => 'Sound system dan lighting terbaik untuk acara indoor maupun outdoor.', 'tentang' => 'Eka Sound System menyediakan layanan sound system dan lighting show profesional untuk berbagai skala acara. Dari acara kecil seperti pengajian dan seminar, hingga konser besar dan festival, kami punya peralatan yang tepat untuk setiap kebutuhan.', 'paket' => [['Paket Sound Full Acara Besar', 8000000, 'Sound system line array + lighting show, 8 jam'], ['Paket Sound Nikahan Sederhana', 1500000, 'Sound system standar 1000W + mic wireless, 5 jam']], 'proyek' => [['Sound System Tabligh Akbar Masjid Raya Baiturrahman', '2024-03-25'], ['Lighting Show Konser Amal Peduli Aceh', '2024-08-12'], ['Sound untuk Sidang Paripurna DPRA', '2024-10-10']]],
                ['name' => 'Irama Lokal Band Aceh', 'bisnis' => 'Irama Lokal Live Music Aceh', 'slug' => 'irama-lokal-band', 'wa' => '6281234564008', 'singkat' => 'Dukung musisi lokal Aceh berbakat dengan memilih kami untuk acara Anda.', 'tentang' => 'Irama Lokal Band adalah platform bagi musisi lokal Aceh berbakat untuk tampil di berbagai acara. Kami mengusung misi memajukan industri musik Aceh sekaligus memberikan pertunjukan berkualitas tinggi dengan harga yang sangat terjangkau.', 'paket' => [['Paket Band Lokal Aceh Support', 2000000, '4 personil band lokal Aceh, 2 jam, sound system basic'], ['Paket Showcase Musisi Aceh', 3500000, '6 personil, 3 jam, variasi genre lokal dan nasional']], 'proyek' => [['Showcase Musik Lokal Festival Aceh Jaya', '2024-05-17'], ['Penampilan Pekan Kebudayaan Aceh di Taman Budaya', '2024-09-18'], ['Konser Musisi Indie Aceh di Kopi Hutan', '2024-11-01']]],
                ['name' => 'Mega Sound & Entertainment', 'bisnis' => 'Mega Sound Entertainment Banda Aceh', 'slug' => 'mega-sound-entertainment', 'wa' => '6281234564009', 'singkat' => 'Sound dan entertainment untuk acara besar dengan ribuan penonton.', 'tentang' => 'Mega Sound & Entertainment memiliki kapabilitas menangani acara dengan 10.000+ penonton. Dengan armada sound system line array terlengkap di Aceh dan tim teknisi berpengalaman, kami siap mendukung konser, festival, dan acara kenegaraan.', 'paket' => [['Paket Event Besar Outdoor', 25000000, 'Sound line array, stage, lighting, LED screen, genset'], ['Paket Konser Indoor Premium', 15000000, 'Sound premium, lighting, LED backdrop, 1000 pax venue']], 'proyek' => [['Sound Festival Seni Rakyat Aceh di Blang Padang', '2024-04-05'], ['Konser Artis Nasional di Hermes Palace Hotel', '2024-09-08'], ['Acara Malam Puncak MTQ Provinsi Aceh', '2024-10-22']]],
                ['name' => 'Musik Indah Aceh', 'bisnis' => 'Musik Indah & Hiburan Keluarga', 'slug' => 'musik-indah-aceh', 'wa' => '6281234564010', 'singkat' => 'Hiburan musik yang menggembirakan untuk acara keluarga dan komunitas.', 'tentang' => 'Musik Indah Aceh menghadirkan hiburan musik yang hangat dan menyenangkan untuk berbagai acara keluarga dan komunitas. Dari penampilan kasual di acara arisan hingga hiburan semi-formal di acara perusahaan, kami selalu tampil dengan sepenuh hati.', 'paket' => [['Paket Musik Keluarga Ceria', 1800000, 'Duo/trio musik akustik, 2 jam, lagu pilihan, sound basic'], ['Paket Akustik Cafe & Restaurant', 800000, 'Duo akustik per malam, 3 jam, background music']], 'proyek' => [['Musik Akustik Arisan PKK Ibu-Ibu RT', '2024-04-16'], ['Live Akustik Launching Menu Baru Kafe Ulee Kareng', '2024-07-14'], ['Hiburan Musik Gathering Alumni SMP 4', '2024-10-07']]],
            ],

            'MC' => [
                ['name' => 'Fadil MC Profesional', 'bisnis' => 'Fadil Master of Ceremony Aceh', 'slug' => 'fadil-mc-profesional', 'wa' => '6281234565001', 'singkat' => 'MC pernikahan profesional dengan pembawaan yang hangat dan menghibur.', 'tentang' => 'Fadil adalah MC pernikahan terpercaya di Banda Aceh dengan pengalaman lebih dari 10 tahun. Dengan suara yang jernih, humor yang cerdas, dan kemampuan bilingual (Indonesia-Aceh), Fadil mampu mencairkan suasana dan membuat tamu merasa nyaman sepanjang acara.', 'paket' => [['Paket MC Pernikahan Full', 2500000, 'MC akad + resepsi, bilingual Aceh-Indonesia, sound koordinasi'], ['Paket MC Resepsi Only', 1500000, 'MC resepsi saja, 4 jam, rundown profesional']], 'proyek' => [['MC Pernikahan Adat Aceh Keluarga Tengku Ahmad', '2024-02-10'], ['MC Acara Peringatan Hari Guru Nasional', '2024-11-25'], ['MC Wisuda Diploma IV Poltek Aceh', '2024-06-15']]],
                ['name' => 'Rahmah MC & Protokoler', 'bisnis' => 'Rahmah MC & Jasa Protokoler', 'slug' => 'rahmah-mc-protokoler', 'wa' => '6281234565002', 'singkat' => 'MC dan protokoler resmi untuk acara kenegaraan dan formal instansi.', 'tentang' => 'Rahmah adalah MC profesional berpengalaman dalam acara formal dan kenegaraan. Dengan latar belakang protokoler pemerintah, Rahmah memahami tata cara, etika, dan protokol resmi untuk berbagai jenis acara formal dari tingkat desa hingga provinsi.', 'paket' => [['Paket MC Acara Formal & Kenegaraan', 3000000, 'MC + protokol resmi, rundown, koordinasi panitia, 6 jam'], ['Paket MC Seminar & Workshop', 1500000, 'MC seminar full day, moderasi diskusi panel']], 'proyek' => [['MC Pelantikan Bupati Aceh Besar', '2024-02-20'], ['MC Seminar Nasional Ekonomi Syariah di Unsyiah', '2024-05-15'], ['Protokoler Kunjungan Presiden ke Aceh', '2024-08-14']]],
                ['name' => 'Zulkifli MC Hiburan', 'bisnis' => 'Zulkifli MC & Stand Up Comedy', 'slug' => 'zulkifli-mc-hiburan', 'wa' => '6281234565003', 'singkat' => 'MC berbakat dengan sentuhan humor cerdas yang membuat tamu tertawa riang.', 'tentang' => 'Zulkifli adalah MC sekaligus komedian berbakat dari Banda Aceh. Dikenal dengan humor yang halus dan tidak menyinggung, Zulkifli mampu menghidupkan suasana acara yang paling sepi sekalipun. Sangat cocok untuk pesta pernikahan, gathering kantor, dan acara keluarga.', 'paket' => [['Paket MC + Stand Up Comedy', 3500000, 'MC acara + 20 menit stand up comedy, 4 jam total'], ['Paket MC Nikahan Ceria', 2000000, 'MC pernikahan dengan humor segar, bilingual, full day']], 'proyek' => [['MC Pernikahan Penuh Tawa Keluarga Syukri', '2024-01-19'], ['Hiburan Stand Up di Gathering PT Arun Aceh', '2024-04-28'], ['MC Acara Malam Keakraban Mahasiswa Baru Unsyiah', '2024-08-30']]],
                ['name' => 'Nursyahra MC Elegan', 'bisnis' => 'Nursyahra MC Pernikahan Elegan', 'slug' => 'nursyahra-mc-elegan', 'wa' => '6281234565004', 'singkat' => 'MC wanita elegan dan karismatik untuk pernikahan yang berkesan dan bermartabat.', 'tentang' => 'Nursyahra adalah MC pernikahan wanita paling banyak diminati di Banda Aceh. Dengan penampilan yang rapi, suara yang memesona, dan kemampuan memandu acara yang terstruktur, setiap pernikahan yang dipandu Nursyahra terasa begitu istimewa dan tak terlupakan.', 'paket' => [['Paket MC Eksklusif Pernikahan', 3500000, 'MC akad & resepsi, busana formal, bilingual, full day'], ['Paket MC Pesta Lamaran/Tunangan', 1200000, 'MC acara lamaran, 2-3 jam, rundown terstruktur']], 'proyek' => [['MC Pernikahan Elegan Ballroom Hermes Palace', '2024-03-09'], ['MC Acara Lamaran Putri Tokoh Masyarakat Aceh', '2024-06-04'], ['MC Peringatan HUT Dharma Wanita Aceh', '2024-08-07']]],
                ['name' => 'Hendra MC Bilingual', 'bisnis' => 'Hendra MC Bilingual Aceh-Indonesia', 'slug' => 'hendra-mc-bilingual', 'wa' => '6281234565005', 'singkat' => 'MC bilingual yang fasih membawakan acara dalam bahasa Aceh dan Indonesia.', 'tentang' => 'Hendra adalah MC bilingual yang sangat fasih menggunakan bahasa Aceh dan bahasa Indonesia. Kemampuan bilingualnya sangat dibutuhkan dalam acara pernikahan adat Aceh yang penuh dengan prosesi dan ucapan adat yang harus disampaikan dengan tepat.', 'paket' => [['Paket MC Adat Aceh Bilingual', 2200000, 'MC adat Aceh fasih, hafal prosesi adat, full day'], ['Paket MC Pengajian & Kenduri', 700000, 'MC pengajian/kenduri adat Aceh, 3 jam']], 'proyek' => [['MC Kenduri Adat Aceh Keluarga Amin', '2024-01-25'], ['MC Maulid Nabi Akbar Masjid Baiturrahman', '2024-09-15'], ['MC Peuyem Breuh Gajah Hadat Pernikahan', '2024-10-30']]],
                ['name' => 'Safira MC Korporat', 'bisnis' => 'Safira MC Profesional Korporat', 'slug' => 'safira-mc-korporat', 'wa' => '6281234565006', 'singkat' => 'MC korporat profesional untuk acara bisnis, seminar, dan launching produk.', 'tentang' => 'Safira adalah MC korporat berpengalaman yang telah memandu berbagai acara bisnis, konferensi, dan product launch dari perusahaan-perusahaan terkemuka di Aceh. Dengan penampilan profesional dan kemampuan improvisasi, Safira menjamin acara berjalan sesuai rencana.', 'paket' => [['Paket MC Corporate Event Full Day', 4000000, 'MC korporat, riset konten, moderasi, koordinasi, 8 jam'], ['Paket MC Product Launch & Expo', 2500000, 'MC launching produk, 4 jam, interaksi audiens, Q&A']], 'proyek' => [['MC Launching Produk Fintech Baru di Aceh', '2024-03-18'], ['MC Annual Meeting PT Bank Aceh Syariah', '2024-05-30'], ['MC Expo UMKM Aceh Kreatif 2024', '2024-11-10']]],
                ['name' => 'Maulana MC Religi', 'bisnis' => 'Maulana MC & Da\'i Muda Aceh', 'slug' => 'maulana-mc-religi', 'wa' => '6281234565007', 'singkat' => 'MC dan da\'i muda yang dapat membawakan acara pernikahan dengan nuansa Islami.', 'tentang' => 'Maulana adalah MC sekaligus da\'i muda berbakat yang spesialis dalam acara-acara bernuansa Islami. Dengan latar belakang pendidikan agama yang kuat dan kemampuan tilawah yang indah, Maulana memberikan dimensi spiritual yang mendalam pada setiap acara.', 'paket' => [['Paket MC + Tilawah + Tausiyah Pernikahan', 2500000, 'MC + tilawah + tausiyah singkat pernikahan, full day'], ['Paket MC Pengajian & Tabligh Akbar', 1500000, 'MC pengajian, 3-4 jam, include pembacaan doa']], 'proyek' => [['MC + Tausiyah Walimah Islami Keluarga Irfan', '2024-02-25'], ['Pembawa Acara Tabligh Akbar Masjid Raya', '2024-04-10'], ['MC Peringatan Isra Miraj Pemerintah Kota', '2024-07-28']]],
                ['name' => 'Tina MC & Presenter', 'bisnis' => 'Tina MC & Presenter TV Aceh', 'slug' => 'tina-mc-presenter', 'wa' => '6281234565008', 'singkat' => 'Presenter TV dan MC profesional dengan pengalaman on-air dan on-ground.', 'tentang' => 'Tina adalah presenter TV aktif sekaligus MC profesional di Banda Aceh. Pengalaman bertahun-tahun di depan kamera membuat Tina sangat percaya diri, luwes, dan mampu beradaptasi dengan berbagai situasi. Sangat cocok untuk acara yang disiarkan live.', 'paket' => [['Paket MC Live Broadcast Event', 5000000, 'MC untuk acara live streaming/siaran, 4 jam'], ['Paket MC Award Night & Gala Dinner', 3500000, 'MC gala dinner elegan, 4 jam, koordinasi rundown']], 'proyek' => [['MC Live TVRI Aceh Malam Anugerah Pendidikan', '2024-03-12'], ['MC Gala Dinner Anniversary Perusahaan Tambang', '2024-07-18'], ['MC Live Streaming Festival Kuliner Aceh', '2024-10-15']]],
                ['name' => 'Rizki MC Muda Aceh', 'bisnis' => 'Rizki MC Muda & Energik', 'slug' => 'rizki-mc-muda-aceh', 'wa' => '6281234565009', 'singkat' => 'MC muda energik yang dapat menghidupkan acara anak muda dan generasi Z.', 'tentang' => 'Rizki adalah MC muda berbakat dengan energy yang tinggi dan koneksi kuat dengan audiens muda. Sangat cocok untuk acara kampus, gathering anak muda, pesta ulang tahun, dan acara modern lainnya. Rizki fasih menggunakan bahasa gaul terkini namun tetap sopan.', 'paket' => [['Paket MC Youth Gathering & Campus Event', 1500000, 'MC anak muda, 3 jam, ice breaking, games interaktif'], ['Paket MC Pesta Ulang Tahun Remaja', 1000000, 'MC pesta ulang tahun, 2 jam, energik, fun']], 'proyek' => [['MC Ospek Mahasiswa Baru Unsyiah 2024', '2024-08-26'], ['MC Ulang Tahun ke-21 Komunitas Pemuda Aceh', '2024-09-21'], ['MC Festival Startup Muda Aceh', '2024-11-14']]],
                ['name' => 'Ustadzah Khadijah MC', 'bisnis' => 'Ustadzah Khadijah MC & Syariah Event', 'slug' => 'ustadzah-khadijah-mc', 'wa' => '6281234565010', 'singkat' => 'MC wanita Islami berpengalaman untuk pengajian, haul, dan acara keagamaan.', 'tentang' => 'Ustadzah Khadijah adalah MC wanita Islami yang sangat berpengalaman dalam memandu berbagai acara keagamaan di Banda Aceh. Dengan penguasaan bahasa Arab, Aceh, dan Indonesia serta hafalan doa yang lengkap, beliau menjadi pilihan utama untuk acara haul, maulid, dan kenduri.', 'paket' => [['Paket MC Pengajian Akbar Wanita', 1200000, 'MC pengajian wanita, 4 jam, bilingual, doa lengkap'], ['Paket MC Haul & Peringatan Keagamaan', 1800000, 'MC haul/peringatan wafat ulama, prosesi lengkap, 5 jam']], 'proyek' => [['MC Pengajian Akbar Ibu-Ibu Majelis Taklim Banda Aceh', '2024-03-08'], ['MC Haul Wali Nanggroe Ke-5', '2024-06-22'], ['MC Musabaqah Tilawatil Quran Tingkat Kota', '2024-08-25']]],
            ],

        ];

        // ──────────────────────────────────────────────────────────────
        // EKSEKUSI: INSERT DATA VENDOR
        // ──────────────────────────────────────────────────────────────
        $addrIndex = 0;
        $credentials = []; // Untuk file kredensial

        foreach ($vendorsData as $categoryName => $vendors) {
            $catId = $categories[$categoryName];
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

                // Buat Vendor
                $vendorId = DB::table('vendors')->insertGetId([
                    'user_id'         => $userId,
                    'category_id'     => $catId,
                    'city_id'         => $cityId,
                    'nama_bisnis'     => $vd['bisnis'],
                    'slug'            => $vd['slug'],
                    'alamat_lengkap'  => $addresses[$addrIndex]['jalan'] . ', ' . $addresses[$addrIndex]['desa'] . ', Kec. ' . $addresses[$addrIndex]['kecamatan'] . ', Banda Aceh',
                    'deskripsi_singkat' => $vd['singkat'],
                    'tentang_kami'    => $vd['tentang'],
                    'no_whatsapp'     => $vd['wa'],
                    'is_verified'     => false, // Semua belum terverifikasi
                    'created_at'      => now(),
                    'updated_at'      => now(),
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

                // Buat Portofolio (Projects) - pakai placeholder image
                foreach ($vd['proyek'] as $j => $proyek) {
                    DB::table('projects')->insert([
                        'vendor_id'      => $vendorId,
                        'judul_project'  => $proyek[0],
                        'tanggal_acara'  => $proyek[1],
                        'deskripsi'      => 'Dokumentasi acara "' . $proyek[0] . '" yang kami kerjakan dengan penuh dedikasi dan profesionalisme.',
                        'cover_image'    => 'projects/placeholder_' . (($j % 5) + 1) . '.jpg',
                        'created_at'     => now(),
                        'updated_at'     => now(),
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
            ['name' => 'Aisyah Rahmawati',   'email' => 'aisyah.rahmawati@gmail.com',   'password' => 'Pelanggan@2024'],
            ['name' => 'Budi Santoso',        'email' => 'budi.santoso@yahoo.com',        'password' => 'Pelanggan@2024'],
            ['name' => 'Cut Nurul Jannah',    'email' => 'cut.nurul@gmail.com',           'password' => 'Pelanggan@2024'],
            ['name' => 'Darmawan Putra',      'email' => 'darmawan.putra@gmail.com',      'password' => 'Pelanggan@2024'],
            ['name' => 'Elvira Susanti',      'email' => 'elvira.susanti@gmail.com',      'password' => 'Pelanggan@2024'],
            ['name' => 'Fadhil Islamuddin',   'email' => 'fadhil.islamuddin@gmail.com',   'password' => 'Pelanggan@2024'],
            ['name' => 'Gita Permata Sari',   'email' => 'gita.permata@gmail.com',        'password' => 'Pelanggan@2024'],
            ['name' => 'Hendra Wijaya',       'email' => 'hendra.wijaya@gmail.com',       'password' => 'Pelanggan@2024'],
            ['name' => 'Indah Lestari',       'email' => 'indah.lestari@gmail.com',       'password' => 'Pelanggan@2024'],
            ['name' => 'Jailani Muhammad',    'email' => 'jailani.m@gmail.com',           'password' => 'Pelanggan@2024'],
            ['name' => 'Kartika Dewi',        'email' => 'kartika.dewi@gmail.com',        'password' => 'Pelanggan@2024'],
            ['name' => 'Lukman Hakim',        'email' => 'lukman.hakim@gmail.com',        'password' => 'Pelanggan@2024'],
            ['name' => 'Mira Agustina',       'email' => 'mira.agustina@gmail.com',       'password' => 'Pelanggan@2024'],
            ['name' => 'Nazaruddin Syah',     'email' => 'nazaruddin.syah@gmail.com',     'password' => 'Pelanggan@2024'],
            ['name' => 'Olivia Chairunnisa',  'email' => 'olivia.chairu@gmail.com',       'password' => 'Pelanggan@2024'],
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
        $this->command->info('✅  - 60 Vendor (10 per kategori, semua belum terverifikasi)');
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

        $currentType = '';
        $currentCategory = '';

        foreach ($credentials as $cred) {
            if ($cred['type'] !== $currentType) {
                $lines[] = '';
                $lines[] = str_repeat('-', 80);
                $lines[] = "  AKUN {$cred['type']}";
                $lines[] = str_repeat('-', 80);
                $currentType     = $cred['type'];
                $currentCategory = '';
            }

            if ($cred['type'] === 'VENDOR' && $cred['category'] !== $currentCategory) {
                $lines[] = '';
                $lines[] = "  [ Kategori: {$cred['category']} ]";
                $lines[] = '';
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

        // Simpan ke storage
        $path = storage_path('app/credentials_akun.txt');
        file_put_contents($path, $content);
    }
}
