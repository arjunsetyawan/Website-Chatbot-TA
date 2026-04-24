<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        User::updateOrCreate(
            ['email' => 'admin@rsud-sultanfatah.com'],
            [
                'name'     => 'Admin Sistem',
                'email'    => 'admin@rsud-sultanfatah.com',
                'password' => Hash::make('admin12345'),
                'role'     => 'admin',
            ]
        );

        // Buat akun pasien demo
        User::updateOrCreate(
            ['email' => 'pasien@rsud-sultanfatah.com'],
            [
                'name'     => 'Pasien Demo',
                'email'    => 'pasien@rsud-sultanfatah.com',
                'password' => Hash::make('pasien12345'),
                'role'     => 'pasien',
            ]
        );

        // Jalankan seeder data pasien (15 data Januari + akun user login)
        $this->call(PasienSeeder::class);
    }
}