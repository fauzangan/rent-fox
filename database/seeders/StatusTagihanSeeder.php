<?php

namespace Database\Seeders;

use App\Models\StatusTagihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusTagihans = [
            [
                'nama_status' => 'Ditagihkan',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Dibayar Sebagian',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Lunas',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Lebih Bayar',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Bermasalah',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Lunas Tanggungan',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Tutup Tanggungan',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'delete',
                'keterangan' => '-'
            ],
        ];

        foreach($statusTagihans as $statusTagihan){
            StatusTagihan::create($statusTagihan);
        }
    }
}
