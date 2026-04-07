<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rekam_medis',
        'no_registrasi',
        'nik',
        'nama',
        'alamat',
        'jenis_kelamin',
        'keluhan_utama',
    ];

    /**
     * Relasi: Pasien memiliki satu User (akun login).
     */
    public function user()
    {
        return $this->hasOne(User::class, 'pasien_id');
    }
}
