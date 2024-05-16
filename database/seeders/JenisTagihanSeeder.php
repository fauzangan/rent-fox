<?php

namespace Database\Seeders;

use App\Models\JenisTagihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisTagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisTagihans = [
            [
                'nama_tagihan' => 'Awal Order',
                'keterangan' => '-',
            ],
            [
                'nama_tagihan' => 'Perpanjangan',
                'keterangan' => '-',
            ],
            [
                'nama_tagihan' => 'Transport',
                'keterangan' => '-',
            ],
            [
                'nama_tagihan' => 'Tanggunan',
                'keterangan' => '-',
            ],
            [
                'nama_tagihan' => 'Periode Final',
                'keterangan' => '-',
            ],
            [
                'nama_tagihan' => 'Lain-Lain',
                'keterangan' => '-',
            ],
        ];

        foreach($jenisTagihans as $jenisTagihan){
            JenisTagihan::create($jenisTagihan);
        }
    }
}
