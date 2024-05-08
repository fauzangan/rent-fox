<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'costumer_id';

    protected $guarded = [
        'costumer_id'
    ];

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
}
