<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = [
        'user_id',
        'pasien_id',
        'tanggal_konsultasi',
        'nama_dokter',
        'poli',
        'jam_praktik',
        'jam_booking',
        'kode_layanan',
        'keluhan',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_konsultasi' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
