<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        // 15 data pasien bulan Januari dari spreadsheet RSUD Sultan Fatah
        $dataPasien = [
            [
                'no_rekam_medis' => '332103500027902',
                'no_registrasi'  => 'RG2025A0004518',
                'nik'            => '3321035000279021',
                'nama'           => 'SUKISWATI',
                'alamat'         => 'TERBOYO KULON 02/01, SEMARANG',
                'jenis_kelamin'  => 'PEREMPUAN',
                'keluhan_utama'  => 'batuk',
            ],
            [
                'no_rekam_medis' => '332103500028209',
                'no_registrasi'  => 'RG2025A0000023',
                'nik'            => '3321035000282091',
                'nama'           => 'MAFTUKHIN',
                'alamat'         => 'PAHESAN 04/01, DEMAK',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'penkes',
            ],
            [
                'no_rekam_medis' => '332103500009918',
                'no_registrasi'  => 'RG2025A0008898',
                'nik'            => '3321035000099181',
                'nama'           => 'AKIB',
                'alamat'         => 'SABAN 08/02, GROBOGAN',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'NYERI PERUT, SESEK',
            ],
            [
                'no_rekam_medis' => '332103500072692',
                'no_registrasi'  => 'RG2025A0009997',
                'nik'            => '3321035000726921',
                'nama'           => 'AYU SHAFIRA FARDIANA',
                'alamat'         => 'DSN PARAS 05/04 PADANG TANGGUNGHARJO, GROBOGAN',
                'jenis_kelamin'  => 'PEREMPUAN',
                'keluhan_utama'  => 'Demam, mual, muntah, nyeri perut',
            ],
            [
                'no_rekam_medis' => '332103500072795',
                'no_registrasi'  => 'RG2025A0010373',
                'nik'            => '3321035000727951',
                'nama'           => 'ERNAWATI',
                'alamat'         => 'BUMIREJO 05/07 KARANGAWEN, DEMAK',
                'jenis_kelamin'  => 'PEREMPUAN',
                'keluhan_utama'  => 'pusing, mual, lemes, diare',
            ],
            [
                'no_rekam_medis' => '332103500037582',
                'no_registrasi'  => 'RG2025A0001039',
                'nik'            => '3321035000375821',
                'nama'           => 'LINDA LAILATUL MAULIDI',
                'alamat'         => 'SAMBI 002/002, DEMAK',
                'jenis_kelamin'  => 'PEREMPUAN',
                'keluhan_utama'  => 'Mual Muntah terus menerus, Pusing, Lemes, Batuk Pilek',
            ],
            [
                'no_rekam_medis' => '332103500042101',
                'no_registrasi'  => 'RG2025A0005643',
                'nik'            => '3321035000421011',
                'nama'           => 'YATMO',
                'alamat'         => 'KENONGO 01/02, DEMAK',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'sesek, batuk',
            ],
            [
                'no_rekam_medis' => '332103500049646',
                'no_registrasi'  => 'RG2025A0006629',
                'nik'            => '3321035000496461',
                'nama'           => 'AHMAD MUALIF',
                'alamat'         => 'BAKALREJO 04/02 GUNTUR, DEMAK',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'pasien mengatakan sesek',
            ],
            [
                'no_rekam_medis' => '332103500023403',
                'no_registrasi'  => 'RG2025A0006366',
                'nik'            => '3321035000234031',
                'nama'           => 'SUNDARI',
                'alamat'         => 'JRAGUNG 04/10, DEMAK',
                'jenis_kelamin'  => 'PEREMPUAN',
                'keluhan_utama'  => 'tdk bs menelan, sesek, mual, nyeri perut, sesak nafas',
            ],
            [
                'no_rekam_medis' => '332103500070832',
                'no_registrasi'  => 'RG2025A0000422',
                'nik'            => '3321035000708321',
                'nama'           => 'TARMONO',
                'alamat'         => 'KEBONAGUNG 4/4 TEGOWANU GROBOGAN, GROBOGAN',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'Pasien mengatakan sesak dan dada terasa panas sejak 3 minggu, hilang timbul, disertai batuk yang tidak produktif',
            ],
            [
                'no_rekam_medis' => '332103500072828',
                'no_registrasi'  => 'RG2025A0010552',
                'nik'            => '3321035000728281',
                'nama'           => 'M ARIEL AKSEL NANDA SAPUTRA',
                'alamat'         => 'CURUG 1/2 TEGOWANU GROBOGAN, GROBOGAN',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'SESAK, BATUK, SARIAWAN',
            ],
            [
                'no_rekam_medis' => '332103500070854',
                'no_registrasi'  => 'RG2025A0000566',
                'nik'            => '3321035000708541',
                'nama'           => 'ASPIAH',
                'alamat'         => 'PENDEM 06/7 TELUK KARANGAWEN DEMAK, DEMAK',
                'jenis_kelamin'  => 'PEREMPUAN',
                'keluhan_utama'  => 'panas dingin, lemes',
            ],
            [
                'no_rekam_medis' => '332103500006878',
                'no_registrasi'  => 'RG2025A0001483',
                'nik'            => '3321035000068781',
                'nama'           => 'NGATMAN',
                'alamat'         => 'CURUG 02/03 MARGOHAYU, DEMAK',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'badan gatel-gatel',
            ],
            [
                'no_rekam_medis' => '332103500038779',
                'no_registrasi'  => 'RG2025A0004944',
                'nik'            => '3321035000387791',
                'nama'           => 'SASWITO',
                'alamat'         => 'BRABO 01/03, GROBOGAN',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'demam naik turun, mual (+), muntah (+)',
            ],
            [
                'no_rekam_medis' => '332103500053855',
                'no_registrasi'  => 'RG2025A0010670',
                'nik'            => '3321035000538551',
                'nama'           => 'ENDANG K',
                'alamat'         => 'GANDAPURA 01/01 JANGGALA, CIAMIS',
                'jenis_kelamin'  => 'LAKI-LAKI',
                'keluhan_utama'  => 'Pasien datang dengan keluhan sesak nafas sudah lama, memberat mulai hari ini dada terasa tidak nyaman',
            ],
        ];

        foreach ($dataPasien as $data) {
            // Buat data pasien
            $pasien = Pasien::updateOrCreate(
                ['no_rekam_medis' => $data['no_rekam_medis']],
                $data
            );

            // Buat akun user login untuk pasien ini
            $namaLower = strtolower(str_replace(' ', '.', $data['nama']));
            $email = $namaLower . '@pasien.rsud-sultanfatah.com';

            User::updateOrCreate(
                ['email' => $email],
                [
                    'name'      => $data['nama'],
                    'email'     => $email,
                    'password'  => Hash::make('pasien12345'),
                    'role'      => 'pasien',
                    'pasien_id' => $pasien->id,
                ]
            );
        }
    }
}
