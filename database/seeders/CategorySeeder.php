<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming a one-to-one relationship with ChildCategory
        $childCategory = ChildCategory::first(); // Or retrieve specific child category

        if ($childCategory) {
            Category::create([
                'name' => 'Category Name', // Replace with desired name
                'child_category_id' => $childCategory->id,
            ]);
        }
    }
}
