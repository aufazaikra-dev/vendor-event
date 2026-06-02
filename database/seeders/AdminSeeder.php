<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya buat admin jika belum ada
        $adminExists = DB::table('users')->where('email', 'admin@eventvendor.com')->exists();

        if (!$adminExists) {
            DB::table('users')->insert([
                'name'       => 'Admin',
                'email'      => 'admin@eventvendor.com',
                'password'   => Hash::make('admin123'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
