<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    public $incrementing = false;

    protected $fillable = [
        'item_id',
        'category_item_id',
        'nama_item',
        'harga_sewa',
        'satuan',
        'satuan_waktu',
        'harga_barang',
        'keterangan',
    ];

    public function categoryItem(){
        return $this->belongsTo(CategoryItem::class, 'category_item_id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Override the boot method to add logic before creating a new item
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $category = CategoryItem::find($item->category_item_id);
            $prefiks= $category->prefiks;

            // Dapatkan ID terakhir untuk kategori ini
            $lastItem = $category->items()->orderBy('item_id', 'desc')->first();
            if ($lastItem) {
                $lastNumber = intval(substr($lastItem->item_id, strlen($prefiks))) + 1;
            } else {
                $lastNumber = 1;
            }

            // Buat ID baru
            $item->item_id = $prefiks . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public static function createItem($data)
    {
        // konversi string to float dan menghilangkan prefix
        $data['harga_sewa'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_sewa']));
        $data['harga_barang'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_barang']));

        return DB::transaction(function () use ($data) {
            return Item::create([
                'nama_item' => $data['nama_item'],
                'category_item_id' => $data['category_item_id'],
                'harga_sewa' => $data['harga_sewa'],
                'satuan_waktu' => $data['satuan_waktu'],
                'satuan_item' => $data['satuan_item'],
                'harga_barang' => $data['harga_barang'],
                'keterangan' => $data['keterangan'],
            ]);
        });
    }

    public function updateItem($data)
    {
        // konversi string to float dan menghilangkan prefix
        $data['harga_sewa'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_sewa']));
        $data['harga_barang'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_barang']));

        return DB::transaction(function () use ($data) {
            return $this->update($data);
        });
    }

}
