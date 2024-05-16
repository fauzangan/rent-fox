<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLogistik extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_logistik_id';

    protected $guarded = ['status_logistik_id'];

    public function logsitikHarian(){
        return $this->hasMany(LogistikHarian::class, 'status_logistik_id', 'status_logisik_id');
    }
}
