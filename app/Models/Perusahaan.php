<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'perusahaan_id';

    protected $fillable = [
        'badan_hukum_id',
        'nama',
        'alamat',
        'kota',
        'provinsi',
        'telp',
        'fax',
    ];

    public function badanHukum(){
        return $this->belongsTo(BadanHukum::class, 'badan_hukum_id');
    }

    public function customer(){
        return $this->hasMany(Customer::class);
    }
}
