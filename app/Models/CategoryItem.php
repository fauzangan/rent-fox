<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_item_id';

    protected $guarded = [
        'category_item_id'
    ];

    public function items(){
        return $this->hasMany(Item::class, 'category_item_id', 'category_item_id');
    }
}
