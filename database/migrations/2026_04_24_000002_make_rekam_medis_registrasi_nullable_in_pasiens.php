<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->string('no_rekam_medis')->nullable()->change();
            $table->string('no_registrasi')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->string('no_rekam_medis')->nullable(false)->change();
            $table->string('no_registrasi')->nullable(false)->change();
        });
    }
};
