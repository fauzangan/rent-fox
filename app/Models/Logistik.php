<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logistik extends Model
{
    use HasFactory;

    protected $primaryKey = 'logistik_id';

    protected $guarded = ['logistik_id'];

    public function logistikHarians(){
        return $this->hasMany(LogistikHarian::class, 'logistik_id', 'logistik_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function reservasiItems(){
        return $this->hasMany(ReservasiItem::class, 'logistik_id', 'logistik_id');
    }

    public function totalLogistiks(){
        return $this->hasMany(TotalLogistik::class, 'logistik_id', 'logistik_id');
    }

    public function scopeFilterByItemId(Builder $query, $itemId)
    {
        if ($itemId) {
            $query->where('item_id', '=', $itemId);
        }
    }

    public function scopeFilterByItemName(Builder $query, $namaItem)
    {
        if ($namaItem) {
            $query->whereHas('item', function($q) use($namaItem){
                $q->where('nama_item', 'like', '%' . $namaItem . '%');
            });
        }
    }

    public function scopeFilterByCategoryItemId(Builder $query, $categoryItemId)
    {
        if ($categoryItemId) {
            $query->whereHas('item', function($q) use($categoryItemId){
                $q->where('category_item_id', '=', $categoryItemId);
            });
        }
    }

    // Accessors
    // public function getBaikAttribute()
    // {
    //     return $this->logistikHarians->sum('baik');
    // }

    // public function getXRinganAttribute()
    // {
    //     return $this->logistikHarians->sum('x_ringan');
    // }

    // public function getXBeratAttribute()
    // {
    //     return $this->logistikHarians->sum('x_berat');
    // }

    // public function getTotalHarianLogAttribute()
    // {
    //     return $this->baik + $this->x_ringan + $this->x_berat;
    // }

    // public function getTotalRentalAttribute()
    // {
    //     return $this->total_harian_log + $this->claim_hilang;
    // }

    // public function getStockGudangAttribute()
    // {
    //     return $this->total_stock - $this->total_rental;
    // }

    // public function getReservasiAttribute()
    // {
    //     return $this->reservasiItems()
    //                 ->whereHas('reservasi', function($query) {
    //                     $query->where('status_reservasi_id', 1);
    //                 })
    //                 ->sum('jumlah_item');
    // }

    // public function getStockReadyAttribute()
    // {
    //     return $this->stock_gudang - $this->reservasi;
    // }

    
}
