<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Customer
            [
                'name' => 'lihat-customers'
            ],
            [
                'name' => 'tambah-customers'
            ],
            [
                'name' => 'edit-customers'
            ],
            [
                'name' => 'hapus-customers'
            ],
            // Order
            [
                'name' => 'lihat-orders'
            ],
            [
                'name' => 'tambah-orders'
            ],
            [
                'name' => 'edit-orders'
            ],
            [
                'name' => 'hapus-orders'
            ],
            // Tagihan
            [
                'name' => 'lihat-tagihans'
            ],
            [
                'name' => 'tambah-tagihans'
            ],
            [
                'name' => 'edit-tagihans'
            ],
            [
                'name' => 'hapus-tagihans'
            ],
            // Logistik Harian
            [
                'name' => 'lihat-logistik-harians'
            ],
            [
                'name' => 'tambah-logistik-harians'
            ],
            [
                'name' => 'edit-logistik-harians'
            ],
            [
                'name' => 'hapus-logistik-harians'
            ],
            // Logistik Total
            [
                'name' => 'lihat-logistik-totals'
            ],
            [
                'name' => 'tambah-logistik-totals'
            ],
            [
                'name' => 'edit-logistik-totals'
            ],
            [
                'name' => 'hapus-logistik-totals'
            ],
            // Logistik
            [
                'name' => 'lihat-logistiks'
            ],
            // Buku Harians
            [
                'name' => 'lihat-buku-harians'
            ],
            [
                'name' => 'tambah-buku-harians'
            ],
            [
                'name' => 'edit-buku-harians'
            ],
            [
                'name' => 'hapus-buku-harians'
            ],
            // Journal Bulanan
            [
                'name' => 'lihat-journal-bulanans'
            ],
            // Items
            [
                'name' => 'lihat-items'
            ],
            [
                'name' => 'tambah-items'
            ],
            [
                'name' => 'edit-items'
            ],
            [
                'name' => 'hapus-items'
            ],
            // Category Items
            [
                'name' => 'lihat-category-items'
            ],
            [
                'name' => 'tambah-category-items'
            ],
            [
                'name' => 'edit-category-items'
            ],
            [
                'name' => 'hapus-category-items'
            ],
            // Reservasi
            [
                'name' => 'lihat-reservasis'
            ],
            [
                'name' => 'tambah-reservasis'
            ],
            [
                'name' => 'edit-reservasis'
            ],
            [
                'name' => 'hapus-reservasis'
            ],
            // Hak Akses
            [
                'name' => 'lihat-hak-akses'
            ],
            [
                'name' => 'tambah-hak-akses'
            ],
            [
                'name' => 'edit-hak-akses'
            ],
            [
                'name' => 'hapus-hak-akses'
            ],
            // Pengguna
            [
                'name' => 'lihat-users'
            ],
            [
                'name' => 'tambah-users'
            ],
            [
                'name' => 'edit-users'
            ],
            [
                'name' => 'hapus-users'
            ],
            // Log Aktivitas
            [
                'name' => 'lihat-log-aktivitas'
            ],
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }
    }
}
