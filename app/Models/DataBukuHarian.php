<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBukuHarian extends Model
{
    use HasFactory;

    protected $primaryKey = 'data_buku_harian_id';

    protected $guarded = ['data_buku_harian_id'];

    public function bukuHarians() {
        return $this->hasMany(BukuHarian::class, 'data_buku_harian_id', 'data_buku_harian_id');
    }
}
