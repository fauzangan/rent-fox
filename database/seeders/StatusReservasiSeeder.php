<?php

namespace Database\Seeders;

use App\Models\StatusReservasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusReservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusReservasis = [
            [
                'nama_status' => 'OK',
                'keterangan' => '-',
            ],
            [
                'nama_status' => 'del',
                'keterangan' => '-',
            ],
        ];

        foreach($statusReservasis as $statusReservasi){
            StatusReservasi::create($statusReservasi);
        }
    }
}
