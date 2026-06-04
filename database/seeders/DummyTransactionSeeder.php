<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use App\Models\User;
use App\Models\Pricelist;
use App\Models\Transaction;
use App\Models\Review;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DummyTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Ambil semua pelanggan (role = user)
        $customers = User::where('role', 'user')->get();

        if ($customers->count() === 0) {
            $this->command->warn('Tidak ada data pelanggan (role: user) ditemukan. Seeder dibatalkan.');
            return;
        }

        // 2. Ambil semua vendor yang aktif (is_verified = true)
        $vendors = Vendor::where('is_verified', true)->get();

        if ($vendors->count() === 0) {
            $this->command->warn('Tidak ada vendor aktif (is_verified = true) ditemukan. Seeder dibatalkan.');
            return;
        }

        $this->command->info('Memulai generate transaksi untuk ' . $vendors->count() . ' vendor aktif...');

        $ulasanPositif = [
            'Pelayanan sangat memuaskan, luar biasa!',
            'Hasilnya sangat bagus sesuai ekspektasi.',
            'Timnya sangat profesional dan ramah.',
            'Harga terjangkau tapi kualitas bintang lima.',
            'Sangat direkomendasikan untuk acara pernikahan!',
            'Semuanya berjalan lancar, terima kasih banyak.',
            'Keluarga kami sangat puas dengan hasilnya.',
            'Kerjanya cepat, rapi, dan komunikatif.',
            'Mantap! Sukses terus untuk bisnisnya.',
            'Pilihan terbaik yang pernah kami buat untuk acara kami.'
        ];

        $ulasanSedang = [
            'Secara keseluruhan bagus, tapi ada sedikit miss komunikasi di awal.',
            'Hasilnya lumayan oke, sesuai dengan harganya.',
            'Bagus, walau butuh waktu lebih lama dari jadwal.',
            'Pelayanan standar, cukup memuaskan.',
            'Tidak ada keluhan berarti, semuanya berjalan baik.'
        ];

        $totalTransactions = 0;

        foreach ($vendors as $vendor) {
            // Ambil paket yang dimiliki vendor
            $pricelists = Pricelist::where('vendor_id', $vendor->id)->get();

            if ($pricelists->count() === 0) {
                continue; // Skip jika vendor tidak punya paket
            }

            // Generate 5-15 transaksi acak per vendor
            $jumlahTransaksi = rand(5, 15);
            $totalTransactions += $jumlahTransaksi;

            for ($i = 0; $i < $jumlahTransaksi; $i++) {
                $customer = $customers->random();
                $paket = $pricelists->random();
                
                // Acak tanggal transaksi mundur ke belakang (max 1 tahun lalu)
                $tanggalTransaksi = Carbon::now()->subDays(rand(1, 365));

                // A. Buat Transaksi
                $transaction = Transaction::create([
                    'kode_pesanan' => 'TRX-' . strtoupper(uniqid()),
                    'vendor_id' => $vendor->id,
                    'user_id' => $customer->id,
                    'pricelist_id' => $paket->id,
                    'status' => 'selesai',
                    'created_at' => $tanggalTransaksi,
                    'updated_at' => $tanggalTransaksi->copy()->addDays(rand(1, 3)), // Selesai beberapa hari kemudian
                ]);

                // B. Buat Ulasan (Review)
                // Rating 4-5 (80% chance), Rating 3 (20% chance)
                $rating = rand(1, 10) > 2 ? rand(4, 5) : 3;
                
                $komentar = ($rating >= 4) 
                            ? $faker->randomElement($ulasanPositif) 
                            : $faker->randomElement($ulasanSedang);

                Review::create([
                    'vendor_id' => $vendor->id,
                    'user_id' => $customer->id,
                    'rating' => $rating,
                    'komentar' => $komentar,
                    'created_at' => $transaction->updated_at,
                    'updated_at' => $transaction->updated_at,
                ]);
            }
        }

        $this->command->info("Berhasil men-generate $totalTransactions transaksi dan ulasan dummy!");
    }
}
