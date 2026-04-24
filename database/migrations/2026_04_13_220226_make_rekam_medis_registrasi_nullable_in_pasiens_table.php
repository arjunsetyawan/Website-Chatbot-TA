<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migrasi ini awalnya dibuat untuk mengubah no_rekam_medis dan no_registrasi
 * menjadi nullable. Perubahan tersebut telah diintegrasikan langsung ke migrasi
 * create_pasiens_table, sehingga migrasi ini tidak perlu melakukan apa-apa.
 * Dipertahankan agar catatan migrasi tetap konsisten.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Sudah ditangani di 2025_01_01_000001_create_pasiens_table.php
        // no_rekam_medis dan no_registrasi sudah nullable dari awal
    }

    public function down(): void
    {
        // Tidak ada yang perlu di-rollback
    }
};
