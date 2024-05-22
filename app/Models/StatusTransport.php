<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTransport extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_transport_id';

    protected $guarded = ['status_transport_id'];

    public function order(){
        return $this->hasMany(Order::class, 'status_transport_id', 'status_transport_id');
    }
}
