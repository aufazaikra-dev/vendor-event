<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminExists = DB::table('users')->where('email', 'admin@eventvendor.com')->exists();

        if (!$adminExists) {
            // Buat admin baru
            DB::table('users')->insert([
                'name'              => 'Admin',
                'email'             => 'admin@eventvendor.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('admin123'),
                'role'              => 'admin',
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        } else {
            // Update password admin yang sudah ada agar selalu sinkron
            DB::table('users')->where('email', 'admin@eventvendor.com')->update([
                'password'          => Hash::make('admin123'),
                'email_verified_at' => now(),
                'role'              => 'admin',
                'updated_at'        => now(),
            ]);
        }
    }
}
