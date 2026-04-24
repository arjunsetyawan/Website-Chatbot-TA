<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Migrasi ini awalnya dibuat untuk menambahkan nilai 'kadaluwarsa' ke ENUM status
 * tabel konsultasi. Perubahan tersebut telah diintegrasikan langsung ke migrasi
 * create_konsultasi_table (2025_01_01_000004), sehingga migrasi ini tidak perlu
 * melakukan apa-apa. Dipertahankan agar catatan migrasi tetap konsisten.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Sudah ditangani di 2025_01_01_000004_create_konsultasi_table.php
        // Status 'kadaluwarsa' sudah ada dalam definisi ENUM dari awal
    }

    public function down(): void
    {
        // Tidak ada yang perlu di-rollback
    }
};
