<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Vestidos', 'slug' => 'vestidos', 'icon' => 'shirt', 'order' => 1],
            ['name' => 'Conjuntos', 'slug' => 'conjuntos', 'icon' => 'package', 'order' => 2],
            ['name' => 'Casual', 'slug' => 'casual', 'icon' => 'coffee', 'order' => 3],
            ['name' => 'Acessórios', 'slug' => 'acessorios', 'icon' => 'watch', 'order' => 4],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
