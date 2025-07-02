<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Gigi',
                'description' => 'Motor bebek untuk kebutuhan sehari-hari',
                'sort_order' => 1,
                'slug' => 'Gigi'
            ],
            [
                'name' => 'Matic',
                'description' => 'Motor automatic untuk kemudahan berkendara',
                'sort_order' => 2,
                'slug' => 'matic'
            ],
            [
                'name' => 'Sport',
                'description' => 'Motor sport untuk performa tinggi',
                'sort_order' => 3,
                'slug' => 'sport'
            ],
            [
                'name' => 'Trill',
                'description' => 'Motor naked bike dengan gaya sporty',
                'sort_order' => 4,
                'slug' => 'trill'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

    }
}
