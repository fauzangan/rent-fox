<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    use HasFactory;

    protected $privateKey = 'status_order_id';

    protected $guarded = ['status_order_id'];

    public function order(){
        return $this->hasMany(Order::class, 'status_order_id', 'status_order_id');
    }
}
