<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTotalLogistik extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_total_logistik_id';

    protected $guarded = ['status_total_logistik_id'];

    public function totalLogistiks()
    {
        return $this->hasMany(TotalLogistik::class, 'status_total_logistik_id', 'status_total_logistik_id');
    }
}
