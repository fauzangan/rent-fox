<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_item_id';

    protected $guarded = [
        'order_item_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }


}
