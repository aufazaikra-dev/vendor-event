<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str; // <-- KITA TAMBAHKAN ALAT PEMBUAT SLUG DI SINI

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Katering',
            'Dekorasi',
            'Makeup Artist (MUA)',
            'Fotografer',
            'Hiburan (Band/DJ)',
            'MC'
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category], // Sistem akan mencari nama ini dulu
                ['slug' => Str::slug($category)] // Jika belum ada, buat baru sekalian isi slug-nya
            );
        }
    }
}
