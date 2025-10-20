<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StafProdi extends Model
{
    use HasFactory;

    protected $table = 'staf_prodi';

    protected $fillable = [
        'program_studi',
        'nama',
        'jabatan',
        'nip',
    ];
}
