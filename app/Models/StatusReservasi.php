<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusReservasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_reservasi_id';

    protected $guarder = ['status_reservasi_id'];

    public function reservasis(){
        return $this->hasMany(Reservasi::class, 'status_reservasi_id', 'status_reservasi_id');
    }
}
