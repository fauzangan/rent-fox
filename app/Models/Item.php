<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'nama_item',
        'harga_sewa',
        'satuan',
        'satuan_waktu',
        'harga_barang',
        'keterangan',
    ];

    public static function createItem($data)
    {
        // konversi string to float dan menghilangkan prefix
        $data['harga_sewa'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_sewa']));
        $data['harga_barang'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_barang']));

        return DB::transaction(function () use ($data) {
            return Item::create([
                'nama_item' => $data['nama_item'],
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

        return DB::transaction(function() use($data) {
            return $this->update($data);
        });
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
}
