<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'tagihan_id';

    protected $guarded = ['tagihan_id'];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function jenisTagihan(){
        return $this->belongsTo(JenisTagihan::class, 'jenis_tagihan_id');
    }

    public function statusTagihan(){
        return $this->belongsTo(StatusTagihan::class, 'status_tagihan_id');
    }
}
