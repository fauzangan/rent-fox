<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'nama_item' => 'Arm Lock',
                'category_item_id' => 1,
                'harga_sewa' => 1500,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 1500,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Cat Walk',
                'category_item_id' => 1,
                'harga_sewa' => 15000,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 280000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Cross Brace 190',
                'category_item_id' => 1,
                'harga_sewa' => 3500,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 75000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Cross Brace 220',
                'category_item_id' => 1,
                'harga_sewa' => 3500,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 75000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Horizontal Frame',
                'category_item_id' => 1,
                'harga_sewa' => 6000,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 200000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Jack Base 40cm',
                'category_item_id' => 1,
                'harga_sewa' => 3500,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 70000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Jack Base 60cm',
                'category_item_id' => 1,
                'harga_sewa' => 1500,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 1500,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Joint Pin',
                'category_item_id' => 1,
                'harga_sewa' => 1400,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 10000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Ladder Frame 90',
                'category_item_id' => 1,
                'harga_sewa' => 5000,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 145000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Main Frame 170',
                'category_item_id' => 1,
                'harga_sewa' => 6000,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 225000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Pipe Support',
                'category_item_id' => 1,
                'harga_sewa' => 12500,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 235000,
                'keterangan' => '-' 
            ],
            [
                'nama_item' => 'Roller Custer',
                'category_item_id' => 1,
                'harga_sewa' => 15000,
                'satuan_item' => 'Buah',
                'satuan_waktu' => 'Bulan',
                'harga_barang' => 280000,
                'keterangan' => '-' 
            ],
        ];

        foreach($items as $item){
            Item::create($item);
        }
    }
}
