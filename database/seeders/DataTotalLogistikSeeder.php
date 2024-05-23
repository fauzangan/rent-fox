<?php

namespace Database\Seeders;

use App\Models\DataTotalLogistik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataTotalLogistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataTotalLogistiks = [
            [
                'nama_data' => 'OK',
                'keterangan' => '-',
            ],
            [
                'nama_data' => 'Claim Hilang',
                'keterangan' => '-',
            ],
            [
                'nama_data' => 'del',
                'keterangan' => '-',
            ],
        ];

        foreach($dataTotalLogistiks as $dataTotalLogistik){
            DataTotalLogistik::create($dataTotalLogistik);
        }
    }
}
