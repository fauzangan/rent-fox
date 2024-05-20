<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTagihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'jenis_tagihan_id';

    protected $guarded = ['jenis_tagihan_id'];

    protected $casts = [
        'tanggal_ditagihkan' => 'datetime',
        'jatuh_tempo_1' => 'datetime',
        'jatuh_tempo_2' => 'datetime',
    ];

    public function tagihans(){
        return $this->hasMany(Tagihan::class, 'jenis_tagihan_id', 'jenis_tagihan_id');
    }
}
