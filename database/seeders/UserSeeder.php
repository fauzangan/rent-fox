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
                'name' => 'Fauzan Zaman',
                'email' => 'fauzan123@gmail.com',
                'username' => 'fauzan123',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Faisal Ahmad',
                'email' => 'faisal123@gmail.com',
                'username' => 'faisal123',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Mita Ayu',
                'email' => 'mita123@gmail.com',
                'username' => 'mita123',
                'password' => Hash::make('password'),
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
