<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTotalLogistik extends Model
{
    use HasFactory;

    protected $primaryKey = 'data_total_logistik_id';

    protected $guarded = ['data_total_logistik_id'];

    public function totalLogistiks()
    {
        return $this->hasMany(TotalLogistik::class, 'data_total_logistik_id', 'data_total_logistik_id');
    }
}
