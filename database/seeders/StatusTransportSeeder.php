<?php

namespace Database\Seeders;

use App\Models\StatusTransport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusTransports= [
            [
                'nama_status' => 'Oleh ASR',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Oleh Customer',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Oleh ASR Sebagian',
                'keterangan' => '-'
            ],
        ];

        foreach($statusTransports as $statusTransport){
            StatusTransport::create($statusTransport);
        }
    }
}
