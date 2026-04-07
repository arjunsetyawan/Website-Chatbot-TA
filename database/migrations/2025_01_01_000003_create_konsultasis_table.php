<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pasien_id')->nullable()->constrained()->onDelete('set null');
            $table->date('tanggal_konsultasi');
            $table->string('nama_dokter');
            $table->string('poli')->default('PARU');
            $table->string('jam_praktik')->nullable();
            $table->string('kode_layanan')->nullable();
            $table->text('keluhan')->nullable();
            $table->enum('status', ['menunggu', 'terkonfirmasi', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasis');
    }
};
