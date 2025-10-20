<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StafFip extends Model
{
    use HasFactory;
    protected $table = 'staf_fip';
    protected $fillable = ['jabatan'];

    public function anggota()
    {
        return $this->hasMany(AnggotaStafFip::class);
    }
}
