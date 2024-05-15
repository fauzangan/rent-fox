<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTagihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_tagihan_id';

    protected $guarded = ['status_tagihan_id'];

    public function tagihans(){
        return $this->hasMany(Tagihan::class);
    }
}
