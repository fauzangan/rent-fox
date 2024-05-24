<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCustomer extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_customer_id';

    protected $guarded = ['status_customer_id'];

    public function customers(){
        return $this->hasMany(Customer::class, 'status_customer_id', 'status_customer_id');
    }
}
