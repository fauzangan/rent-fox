<?php

namespace Database\Seeders;

use App\Models\StatusCustomer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusCustomers = [
            [
                'nama_status' => 'Aktif',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'Kadaluarsa',
                'keterangan' => '-'
            ],
            [
                'nama_status' => 'del',
                'keterangan' => '-'
            ],
        ];

        foreach($statusCustomers as $statusCustomer){
            StatusCustomer::create($statusCustomer);
        }
    }
}
