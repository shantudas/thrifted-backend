<?php

namespace Database\Seeders;

use App\Models\ChildCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $childCategories = [
            [
                'name' => 'Laptops',
                'parent_category_id' => 1, // Reference parent category ID
            ],
            [
                'name' => 'Phones',
                'parent_category_id' => 1, // Reference parent category ID
            ],
            [
                'name' => 'T-Shirts',
                'parent_category_id' => 2, // Reference parent category ID
            ],
            [
                'name' => 'Jeans',
                'parent_category_id' => 2, // Reference parent category ID
            ],
            [
                'name' => 'Furniture',
                'parent_category_id' => 3, // Reference parent category ID
            ],
        ];

        foreach ($childCategories as $data) {
            ChildCategory::create($data);
        }
    }
}
