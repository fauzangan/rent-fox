<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'perusahaan_id';

    protected $fillable = [
        'badan_hukum',
        'nama',
        'alamat',
        'kota',
        'provinsi',
        'telp',
        'fax',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
