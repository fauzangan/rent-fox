<?php

namespace Database\Seeders;

use App\Models\DataBukuHarian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataBukuHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataBukuHarians = [
            [
                'nama_data' => 'OK',
                'keterangan' => '-'
            ],
            [
                'nama_data' => 'del',
                'keterangan' => '-'
            ],
        ];

        foreach($dataBukuHarians as $dataBukuHarian){
            DataBukuHarian::create($dataBukuHarian);
        }
    }
}
