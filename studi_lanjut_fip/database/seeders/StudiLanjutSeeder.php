<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudiLanjut;
use Carbon\Carbon;

class StudiLanjutSeeder extends Seeder
{
    public function run()
    {
        StudiLanjut::create([
            'nama' => 'Dr. Ahmad Sutrisno',
            'jenis_studi' => 'Beasiswa',
            'jenjang' => 'S3',
            'status_studi' => 'Aktif',
            'lokasi' => 'Luar Negeri',
            'tempat_studi' => 'University of Melbourne',
            'bidang_studi' => 'Pendidikan',
            'periode_awal' => '2024-08-01',
            'periode_akhir' => '2027-07-31',
            'sumber_biaya' => 'Beasiswa Pemerintah',
            'progress' => 30,
            'progress_november_2024' => 10,
        ]);
    }
}
