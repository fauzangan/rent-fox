<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogistikHarian extends Model
{
    use HasFactory;

    protected $primaryKey = 'logistik_harian_id';

    protected $guarded = ['logistik_harian_id'];

    public function logistik(){
        return $this->belongsTo(Logistik::class, 'logistik_id', 'logistik_id');
    }
}
