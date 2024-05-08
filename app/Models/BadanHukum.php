<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadanHukum extends Model
{
    use HasFactory;

    protected $primaryKey = 'badan_hukum_id';

    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    public function perusahaan(){
        return $this->hasMany(Perusahaan::class, 'badan_hukum_id');
    }
}
