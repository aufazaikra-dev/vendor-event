<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Kota (Jakarta, Bandung, dll)
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // jakarta-selatan
            $table->timestamps();
        });

        // 2. Tabel Kategori (Catering, Photo, dll)
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable(); // Ikon kategori
            $table->timestamps();
        });

        // 3. Tabel Vendor (Profil Bisnis)
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pemilik Akun
            $table->foreignId('category_id')->constrained(); // Jenis Vendor
            $table->foreignId('city_id')->constrained(); // Lokasi

            $table->string('nama_bisnis');
            $table->string('slug')->unique();
            $table->text('alamat_lengkap');
            $table->text('deskripsi_singkat'); // Muncul di kartu depan
            $table->longText('tentang_kami'); // Muncul di detail profil

            $table->string('logo')->nullable();
            $table->string('banner_image')->nullable(); // Foto sampul besar ala Bridestory
            $table->string('no_whatsapp');
            $table->string('website_url')->nullable();
            $table->string('instagram_url')->nullable();

            $table->boolean('is_verified')->default(false); // Centang Biru
            $table->timestamps();
        });

        // 4. Tabel Projects (Album Foto / Bukti Karya)
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->string('judul_project'); // Misal: "Intimate Wedding at Bali"
            $table->date('tanggal_acara')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('cover_image'); // Foto utama project
            $table->timestamps();
        });

        // 5. Tabel Pricelists (Paket Harga) -> SUMBER DATA SAW KRITERIA HARGA
        Schema::create('pricelists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->string('nama_paket'); // Misal: "Paket Gold 500 Pax"
            $table->bigInteger('harga'); // 50000000
            $table->text('fitur_paket'); // List apa saja yang didapat
            $table->string('file_brosur')->nullable(); // Upload PDF brosur (Opsional)
            $table->timestamps();
        });

        // 6. Tabel Reviews (Ulasan User) -> SUMBER DATA SAW KRITERIA RATING
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('rating'); // 1 sampai 5
            $table->text('komentar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('pricelists');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('cities');
    }
};
