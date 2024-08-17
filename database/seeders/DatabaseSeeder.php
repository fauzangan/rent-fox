<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            ProvinsiSeeder::class,
            StatusCustomerSeeder::class,
            CustomerSeeder::class,
            CategoryItemSeeder::class,
            ItemSeeder::class,
            StatusOrderSeeder::class,
            StatusTransportSeeder::class,
            JenisTagihanSeeder::class,
            StatusTagihanSeeder::class,
            StatusLogistikSeeder::class,
            StatusTotalLogistikSeeder::class,
            DataTotalLogistikSeeder::class,
            StatusReservasiSeeder::class,
            GroupBiayaSeeder::class,
            PostingBiayaSeeder::class,
            DataBukuHarianSeeder::class,
            RolePermissionSeeder::class,
            RoleSeeder::class
        ]);
    }
}
