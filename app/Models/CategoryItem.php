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

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($category) {
            if ($category->isDirty('prefiks')) {
                $oldPrefiks = $category->getOriginal('prefiks');
                $newPrefiks = $category->prefiks;

                // Ambil semua item yang berhubungan dengan kategori ini
                $items = $category->items;

                foreach ($items as $item) {
                    // Perbarui item_id dengan prefiks baru
                    $oldItemId = $item->item_id;
                    $oldNumber = intval(substr($oldItemId, strlen($oldPrefiks)));
                    $newItemId = $newPrefiks . str_pad($oldNumber, 3, '0', STR_PAD_LEFT);
                    $item->item_id = $newItemId;
                    $item->save();
                }
            }
        });
    }

    public function items(){
        return $this->hasMany(Item::class, 'category_item_id', 'category_item_id');
    }
}
