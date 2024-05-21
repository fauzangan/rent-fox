<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservasi_item_id';

    protected $guarded = ['reservasi_item_id'];

    public function reservasi(){
        return $this->belongsTo(Reservasi::class, 'reservasi_id', 'reservasi_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

    public function logistik(){
        return $this->belongsTo(Logistik::class, 'logistik_id', 'logistik_id');
    }
}
