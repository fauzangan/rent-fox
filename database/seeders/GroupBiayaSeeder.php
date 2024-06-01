<?php

namespace Database\Seeders;

use App\Models\GroupBiaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupBiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupBiayas = [
            [
                'nama_group' => 'PENDAPATAN RENTAL',
                'prefiks' => 'A',  
            ],
            [
                'nama_group' => 'PENGELUARAN RENTAL',
                'prefiks' => 'B',  
            ],
            [
                'nama_group' => 'PENDAPATAN SELAIN RENTAL',
                'prefiks' => 'C',  
            ],
            [
                'nama_group' => 'PENGELUARAN SELAIN RENTAL',
                'prefiks' => 'D',  
            ],
        ];

        foreach($groupBiayas as $groupBiaya){
            GroupBiaya::create($groupBiaya);
        }
    }
}
