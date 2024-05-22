<?php

namespace Database\Seeders;

use App\Models\StatusOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusOrders = [
            [
                'nama_status' => 'Aktif',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Tutup',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Tunda/Batal',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'del',
                'keterangan' => '-'
            ],
        ];

        foreach($statusOrders as $statusOrder){
            StatusOrder::create($statusOrder);
        }
    }
}
