<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistik extends Model
{
    use HasFactory;

    protected $primaryKey = 'logistik_id';

    protected $guarded = ['logistik_id'];

    public function logistikHarian(){
        return $this->hasMany(LogistikHarian::class, 'logistik_id', 'logistik_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
