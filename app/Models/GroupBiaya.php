<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupBiaya extends Model
{
    use HasFactory;

    protected $primaryKey = 'group_biaya_id';

    protected $guarded = ['group_biaya_id'];

    public function postingBiayas(){
        return $this->hasMany(PostingBiaya::class, 'group_biaya_id', 'group_biaya_id');
    }
}
