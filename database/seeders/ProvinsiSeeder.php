<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsis = [
            "Aceh", 
            "Bali", 
            "Banten", 
            "Bengkulu", 
            "DKI Yogyakarta", 
            "DKI Jakarta", 
            "Gorontalo", 
            "Jambi", 
            "Jawa Barat", 
            "Jawa Tengah", 
            "Jawa Timur", 
            "Kalimantan Barat", 
            "Kalimantan Selatan", 
            "Kalimantan Tengah", 
            "Kalimantan Timur", 
            "Kalimantan Utara", 
            "Kepulauan Bangka Belitung", 
            "Kepulauan Riau", 
            "Lampung", 
            "Maluku", 
            "Maluku Utara", 
            "Nusa Tenggara Barat", 
            "Nusa Tenggara Timur", 
            "Papua", 
            "Papua Barat", 
            "Riau", 
            "Sulawesi Barat", 
            "Sulawesi Selatan", 
            "Sulawesi Tengah", 
            "Sulawesi Tenggara", 
            "Sulawesi Utara", 
            "Sumatera Barat", 
            "Sumatera Selatan", 
            "Sumatera Utara"
        ];

        foreach($provinsis as $provinsi){
            Provinsi::create([
                'nama' => $provinsi
            ]);
        }
    }
}
