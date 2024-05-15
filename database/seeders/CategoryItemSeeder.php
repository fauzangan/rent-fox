<?php

namespace Database\Seeders;

use App\Models\CategoryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryItems = [
            [
                'nama_category' => 'Scaffolding',
                'prefiks' => 'CF',
                'keterangan' => '-'
            ],
            [
                'nama_category' => 'Equipment',
                'prefiks' => 'EQ',
                'keterangan' => '-'
            ],
        ];

        foreach($categoryItems as $categoryItem){
            CategoryItem::create($categoryItem);
        }
    }
}
