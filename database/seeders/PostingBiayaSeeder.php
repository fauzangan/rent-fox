<?php

namespace Database\Seeders;

use App\Models\PostingBiaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostingBiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postingBiayas = [
            [
                'nama_posting' => 'Pendapatan Sewa',
                'group_biaya_id' => 1,  
            ],
            [
                'nama_posting' => 'Pendapatan Ganti Rugi',
                'group_biaya_id' => 1,  
            ],
            [
                'nama_posting' => 'Pendapatan Lain-lain',
                'group_biaya_id' => 1,  
            ],
            [
                'nama_posting' => 'Pendapatan Claim Kerusakan',
                'group_biaya_id' => 1,  
            ],
            [
                'nama_posting' => 'Pendapatan Claim Hilang',
                'group_biaya_id' => 1,  
            ],
            [
                'nama_posting' => 'Pendapatan Transportasi',
                'group_biaya_id' => 1,  
            ],
            [
                'nama_posting' => 'Pengeluaran Maintenance & Alat Kerja',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Subcontractor & Operator',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Transportasi',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Bongkar Muat',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Gaji Staff',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Upah Harian',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Administrasi Kantor',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Operasional Proyek',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Overhead',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pengeluaran Lain (Rental)',
                'group_biaya_id' => 2,  
            ],
            [
                'nama_posting' => 'Pendapatan dari Lelang Jual',
                'group_biaya_id' => 3,  
            ],
            [
                'nama_posting' => 'Pendapatan dari Hutang/Tanggungan',
                'group_biaya_id' => 3,  
            ],
            [
                'nama_posting' => 'Pengeluaran u/ Pengadaan Scaffolding',
                'group_biaya_id' => 4,  
            ],
            [
                'nama_posting' => 'Pengeluaran/Bayar Hutang/Tanggungan',
                'group_biaya_id' => 4,  
            ],
        ];

        foreach($postingBiayas as $postingBiaya){
            PostingBiaya::createPostingBiaya($postingBiaya);
        }
    }
}
