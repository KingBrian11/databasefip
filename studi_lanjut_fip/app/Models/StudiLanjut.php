<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudiLanjut extends Model
{
    use HasFactory;

    protected $table = 'studi_lanjut';

    protected $fillable = [
        'nama',
         'nip',
    'golongan',
    'unit_kerja',
        'jenis_studi',
        'jenjang',
        'status_studi',
        'lokasi',
        'tempat_studi',
        'bidang_studi',
        'periode_awal',
        'periode_akhir',
        'tugas_belajar_sk_exist',
        'tugas_belajar_sk_nomor',
        'tugas_belajar_sk_path',
        'izin_belajar_exist',
        'izin_belajar_nomor',
        'izin_belajar_path',
        'sumber_biaya',
        'progress',
        'progress_november_2024',
    ];
    protected $casts = [
    'progress' => 'string',
    'progress_november_2024' => 'string',
];

}
