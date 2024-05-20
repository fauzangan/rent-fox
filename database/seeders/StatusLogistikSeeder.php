<?php

namespace Database\Seeders;

use App\Models\StatusLogistik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusLogistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusLogistiks = [
            [
                'nama_status' => 'Pengiriman',
                'keterangan' => 'Pengiriman Barang oleh ASR Kepada Customer',
            ],
            [
                'nama_status' => 'Pengembalian',
                'keterangan' => 'Pengembalian Barang oleh Customer Kepada ASR',
            ],
        ];
        
        foreach($statusLogistiks as $statusLogistik){
            StatusLogistik::create($statusLogistik);
        }
    }
}
