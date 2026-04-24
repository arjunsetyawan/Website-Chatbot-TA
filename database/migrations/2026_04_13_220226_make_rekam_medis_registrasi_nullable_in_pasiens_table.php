<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            // Drop unique constraints first, then make nullable
            $table->dropUnique(['no_rekam_medis']);
            $table->dropUnique(['no_registrasi']);

            $table->string('no_rekam_medis')->nullable()->change();
            $table->string('no_registrasi')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->string('no_rekam_medis')->nullable(false)->change();
            $table->string('no_registrasi')->nullable(false)->change();

            $table->unique('no_rekam_medis');
            $table->unique('no_registrasi');
        });
    }
};
