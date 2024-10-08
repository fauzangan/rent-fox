<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Karyawan 1',
                'email' => 'karyawan1@gmail.com',
                'username' => 'karyawan1',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Karyawan 2',
                'email' => 'karyawan2@gmail.com',
                'username' => 'karyawan2',
                'password' => Hash::make('password'),
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
