<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah nilai 'kadaluwarsa' ke ENUM status di tabel konsultasi
        DB::statement("ALTER TABLE konsultasi MODIFY COLUMN status ENUM('menunggu','terkonfirmasi','dibatalkan','selesai','kadaluwarsa') NOT NULL DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        // Kembalikan ENUM tanpa 'kadaluwarsa' (pastikan tidak ada data kadaluwarsa sebelum rollback)
        DB::statement("ALTER TABLE konsultasi MODIFY COLUMN status ENUM('menunggu','terkonfirmasi','dibatalkan','selesai') NOT NULL DEFAULT 'menunggu'");
    }
};
