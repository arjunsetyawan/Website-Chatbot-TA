<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('konsultasis', 'konsultasi');

        // Add jam_booking column for the specific slot time
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->string('jam_booking', 10)->nullable()->after('jam_praktik');
        });
    }

    public function down(): void
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->dropColumn('jam_booking');
        });

        Schema::rename('konsultasi', 'konsultasis');
    }
};
