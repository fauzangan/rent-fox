<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin'],
            ['name' => 'Manajer'],
            ['name' => 'Karyawan'],
        ];

        foreach($roles as $role){
            Role::create($role);
        }

        $user = User::find(1); // Mengambil satu instance User berdasarkan ID
        $user->assignRole('Super Admin'); // Ini akan bekerja

    }
}
