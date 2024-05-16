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
        'x_ringan',
        'x_berat',
        'hilang',
        'keterangan',
    ];

    public function categoryItem()
    {
        return $this->belongsTo(CategoryItem::class, 'category_item_id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'item_id', 'item_id');
    }

    public function logistik()
    {
        return $this->hasOne(Logistik::class, 'item_id', 'item_id');
    }


    // Override the boot method to add logic before creating a new item
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            self::generateItemId($item);
        });

        static::updating(function ($item) {
            if ($item->isDirty('category_item_id')) {
                $oldItemId = $item->getOriginal('item_id');
                self::generateItemId($item);
                $item->updateRelatedIds($oldItemId, $item->item_id);
            }
        });
    }

    public static function generateItemId($item)
    {
        $category = CategoryItem::find($item->category_item_id);
        $prefiks = $category->prefiks;

        // Dapatkan ID terakhir untuk kategori ini
        $lastItem = $category->items()->orderBy('item_id', 'desc')->first();
        if ($lastItem) {
            $lastNumber = intval(substr($lastItem->item_id, strlen($prefiks))) + 1;
        } else {
            $lastNumber = 1;
        }

        // Buat ID baru
        $item->item_id = $prefiks . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
    }

    // Method untuk memperbarui ID pada relasi yang terkait
    public function updateRelatedIds($newItemId)
    {
        // Perbarui ID pada relasi Logistik
        if ($this->logistik) {
            $this->logistik->update(['item_id' => $newItemId]);
        }

    }

    public static function createItem($data)
    {
        // konversi string to float dan menghilangkan prefix
        $data['harga_sewa'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_sewa']));
        $data['harga_barang'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_barang']));
        $data['x_ringan'] = (int)str_replace(',', '.', str_replace('.', '', $data['x_ringan']));
        $data['x_berat'] = (float)($data['x_berat'] / 100);
        $data['hilang'] = (float)($data['hilang'] / 100);
        
        return DB::transaction(function () use ($data) {
            
            $item = Item::create([
                'nama_item' => $data['nama_item'],
                'category_item_id' => $data['category_item_id'],
                'harga_sewa' => $data['harga_sewa'],
                'satuan_waktu' => $data['satuan_waktu'],
                'satuan_item' => $data['satuan_item'],
                'harga_barang' => $data['harga_barang'],
                'x_ringan' => $data['x_ringan'],
                'x_berat' => $data['x_berat'],
                'hilang' => $data['hilang'],
                'keterangan' => $data['keterangan'],
            ]);
            
            Logistik::create([
                'item_id' => $item->item_id,
                'stock_awal' => $data['stock_awal'],
                'total_stock' => $data['stock_awal'],
                'stock_ready' => $data['stock_awal'],
            ]);

            return $item;
        });
    }

    public function updateItem($data)
    {
        // konversi string to float dan menghilangkan prefix
        $data['harga_sewa'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_sewa']));
        $data['harga_barang'] = (float)str_replace(',', '.', str_replace('.', '', $data['harga_barang']));
        $data['x_ringan'] = (float)str_replace(',', '.', str_replace('.', '', $data['x_ringan']));
        $data['x_berat'] = (float)($data['x_berat'] / 100);
        $data['hilang'] = (float)($data['hilang'] / 100);


        return DB::transaction(function () use ($data) {
            $item = $this;
            $logistik = $this->logistik;

            // Isi model dengan data baru sebelum mengecek isDirty
            $item->fill([
                'nama_item' => $data['nama_item'],
                'category_item_id' => $data['category_item_id'],
                'harga_sewa' => $data['harga_sewa'],
                'satuan_waktu' => $data['satuan_waktu'],
                'satuan_item' => $data['satuan_item'],
                'harga_barang' => $data['harga_barang'],
                'x_ringan' => $data['x_ringan'],
                'x_berat' => $data['x_berat'],
                'hilang' => $data['hilang'],
                'keterangan' => $data['keterangan'],
            ]);

            if ($item->isDirty()) {
                $item->save(); // Save hanya jika ada perubahan
            }

            // Hitung ulang logistik dan periksa perubahan
            $logistik->total_log += $data['total_log'];
            $logistik->total_stock = $logistik->stock_awal + $logistik->total_log - $logistik->claim_hilang;

            if ($logistik->isDirty()) {
                $logistik->save(); // Save hanya jika ada perubahan
            }

            return $this;
        });
    }
}
