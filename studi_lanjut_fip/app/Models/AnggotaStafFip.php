<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaStafFip extends Model
{
    use HasFactory;
    protected $table = 'anggota_staf_fip';
    protected $fillable = ['staf_fip_id', 'nama'];

    public function stafFip()
    {
        return $this->belongsTo(StafFip::class);
    }
}
