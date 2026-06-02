<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\City;
use App\Models\Pricelist;
use App\Models\Transaction;

class TransactionAndReviewTest extends TestCase
{
    use RefreshDatabase;

    private $vendorUser;
    private $vendor;
    private $normalUser;
    private $pricelist;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Setup Kategori dan Kota (Syarat membuat Vendor)
        $category = Category::create(['name' => 'Katering', 'slug' => 'katering']);
        $city = City::create(['name' => 'Banda Aceh', 'slug' => 'banda-aceh']);

        // 2. Setup Vendor User
        $this->vendorUser = User::factory()->create(['role' => 'vendor']);
        
        // 3. Setup Profil Vendor
        $this->vendor = Vendor::create([
            'user_id' => $this->vendorUser->id,
            'category_id' => $category->id,
            'city_id' => $city->id,
            'nama_bisnis' => 'Vendor Test',
            'slug' => 'vendor-test',
            'alamat_lengkap' => 'Jl. Test',
            'deskripsi_singkat' => 'Test Singkat',
            'tentang_kami' => 'Test Panjang',
            'no_whatsapp' => '08123456789',
            'is_verified' => true
        ]);

        // 4. Setup Pricelist
        $this->pricelist = Pricelist::create([
            'vendor_id' => $this->vendor->id,
            'nama_paket' => 'Paket Hemat',
            'harga' => 100000,
            'fitur_paket' => 'Murah'
        ]);

        // 5. Setup Normal User
        $this->normalUser = User::factory()->create(['role' => 'user']);
    }

    public function test_vendor_can_create_transaction()
    {
        $response = $this->actingAs($this->vendorUser)->post('/vendor/pesanan', [
            'user_id' => $this->normalUser->id,
            'pricelist_id' => $this->pricelist->id
        ]);

        $response->assertSessionHas('success');
        
        // Cek database
        $this->assertDatabaseHas('transactions', [
            'vendor_id' => $this->vendor->id,
            'user_id' => $this->normalUser->id,
            'pricelist_id' => $this->pricelist->id,
            'status' => 'sedang_dilaksanakan'
        ]);
    }

    public function test_vendor_can_update_transaction_status()
    {
        // Buat transaksi dummy awal
        $transaction = Transaction::create([
            'kode_pesanan' => 'ORD-TEST',
            'vendor_id' => $this->vendor->id,
            'user_id' => $this->normalUser->id,
            'pricelist_id' => $this->pricelist->id,
            'status' => 'sedang_dilaksanakan'
        ]);

        $response = $this->actingAs($this->vendorUser)->put("/vendor/pesanan/{$transaction->id}", [
            'status' => 'selesai'
        ]);

        $response->assertSessionHas('success');

        // Cek apakah status berubah
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => 'selesai'
        ]);
    }

    public function test_user_cannot_review_unfinished_transaction()
    {
        // Buat transaksi yang belum selesai
        $transaction = Transaction::create([
            'kode_pesanan' => 'ORD-TEST-2',
            'vendor_id' => $this->vendor->id,
            'user_id' => $this->normalUser->id,
            'pricelist_id' => $this->pricelist->id,
            'status' => 'sedang_dilaksanakan'
        ]);

        // Login sebagai user biasa, coba kirim review
        $response = $this->actingAs($this->normalUser)->post("/user/pesanan/{$transaction->id}/review", [
            'rating' => 5,
            'komentar' => 'Bagus sekali!'
        ]);

        // Harus gagal dan menampilkan pesan error dari controller
        $response->assertSessionHas('error', 'Pesanan belum selesai. Anda belum bisa memberikan ulasan.');
        
        // Pastikan tidak ada review yang tersimpan
        $this->assertDatabaseMissing('reviews', [
            'transaction_id' => $transaction->id
        ]);
    }

    public function test_user_can_review_finished_transaction()
    {
        // Buat transaksi yang sudah SELESAI
        $transaction = Transaction::create([
            'kode_pesanan' => 'ORD-TEST-3',
            'vendor_id' => $this->vendor->id,
            'user_id' => $this->normalUser->id,
            'pricelist_id' => $this->pricelist->id,
            'status' => 'selesai' // <--- Penting
        ]);

        $response = $this->actingAs($this->normalUser)->post("/user/pesanan/{$transaction->id}/review", [
            'rating' => 4,
            'komentar' => 'Mantap!'
        ]);

        $response->assertSessionHas('success');

        // Cek database
        $this->assertDatabaseHas('reviews', [
            'transaction_id' => $transaction->id,
            'user_id' => $this->normalUser->id,
            'vendor_id' => $this->vendor->id,
            'rating' => 4,
            'komentar' => 'Mantap!'
        ]);
    }

    public function test_user_cannot_review_twice()
    {
        // Buat transaksi yang sudah SELESAI
        $transaction = Transaction::create([
            'kode_pesanan' => 'ORD-TEST-4',
            'vendor_id' => $this->vendor->id,
            'user_id' => $this->normalUser->id,
            'pricelist_id' => $this->pricelist->id,
            'status' => 'selesai'
        ]);

        // Review PERTAMA
        $this->actingAs($this->normalUser)->post("/user/pesanan/{$transaction->id}/review", [
            'rating' => 5,
            'komentar' => 'Hebat'
        ]);

        // Review KEDUA
        $response = $this->actingAs($this->normalUser)->post("/user/pesanan/{$transaction->id}/review", [
            'rating' => 3,
            'komentar' => 'Biasa aja'
        ]);

        // Harus di-block oleh controller
        $response->assertSessionHas('error', 'Anda sudah memberikan ulasan untuk pesanan ini.');
        
        // Cek database, pastikan rating tetap 5 (Review pertama)
        $this->assertDatabaseHas('reviews', [
            'transaction_id' => $transaction->id,
            'rating' => 5
        ]);
        
        $this->assertDatabaseMissing('reviews', [
            'transaction_id' => $transaction->id,
            'rating' => 3
        ]);
    }
}
