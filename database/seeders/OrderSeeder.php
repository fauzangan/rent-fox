<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                "tanggal_order" => "01/06/2024",
                "tanggal_kirim" => "14/06/2024",
                "customer_id" => "1",
                "kirim_kepada" => "Daffa",
                "alamat_kirim" => "Semarang Tawang Bank Jateng",
                "nama_proyek" => "Membangun Stasiun",
                "status_transport_id" => "1",
                "status_order_id" => "1",
                "keterangan" => "-",
                "items" => ["CF001","CF003","CF012","CF004","CF002",],
                "jumlah_items" => ["100","200", "30","40","50",],
                "waktus" => ["1","1","1","1","1",],
                "jumlah_hargas" => ["150.000","700.000","450.000","140.000","750.000",],
            ],
            [
                "tanggal_order" => "01/06/2024",
                "tanggal_kirim" => "14/06/2024",
                "customer_id" => "2",
                "kirim_kepada" => "Suryono",
                "alamat_kirim" => "Simpang Lima No. 30",
                "nama_proyek" => "Membangun Mall",
                "status_transport_id" => "1",
                "status_order_id" => "1",
                "keterangan" => "-",
                "items" => [ "CF001","CF003","CF012","CF004","CF002",],
                "jumlah_items" => [ "100","200","30","40","50",],
                "waktus" => [ "1","1","1","1","1",],
                "jumlah_hargas" => [ "150.000","700.000","450.000","140.000","750.000",],
            ],
            [
                "tanggal_order" => "01/06/2024",
                "tanggal_kirim" => "14/06/2024",
                "customer_id" => "3",
                "kirim_kepada" => "Sumarsih",
                "alamat_kirim" => "Tembalang Selatan No. V",
                "nama_proyek" => "Membangun Rumah",
                "status_transport_id" => "1",
                "status_order_id" => "1",
                "keterangan" => "-",
                "items" => ["CF001","CF003","CF012","CF004","CF002",],
                "jumlah_items" => ["100","200","30","40","50",],
                "waktus" => ["1","1","1","1","1",],
                "jumlah_hargas" => ["150.000","700.000","450.000","140.000","750.000",],
            ]
        ];

        foreach($orders as $order){
            Order::createOrderWithItems($order);
        }
    }
}
