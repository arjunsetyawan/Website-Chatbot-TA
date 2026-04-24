<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->date('tanggal_konsultasi');
            $table->string('nama_dokter');
            $table->string('poli');
            $table->string('jam_praktik', 20);
            $table->string('jam_booking', 10)->nullable();
            $table->string('kode_layanan')->nullable();
            $table->text('keluhan')->nullable();
            $table->enum('status', ['menunggu', 'terkonfirmasi', 'dibatalkan', 'selesai', 'kadaluwarsa'])
                  ->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
