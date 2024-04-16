<?php

namespace Database\Seeders;

use App\Models\ParentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parentCategories = [
            'Electronics',
            'Clothing',
            'Home Goods',
        ];

        foreach ($parentCategories as $name) {
            ParentCategory::create([
                'name' => $name,
            ]);
        }
    }
}
