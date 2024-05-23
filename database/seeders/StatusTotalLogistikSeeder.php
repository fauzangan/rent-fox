<?php

namespace Database\Seeders;

use App\Models\StatusTotalLogistik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTotalLogistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusTotalLogistiks = [
            [
                'nama_status' => 'Penambahan',
                'keterangan' => '-',
            ],
            [
                'nama_status' => 'Pengurangan',
                'keterangan' => '-',
            ],
        ];

        foreach($statusTotalLogistiks as $statusTotalLogistik){
            StatusTotalLogistik::create($statusTotalLogistik);
        }
    }
}
