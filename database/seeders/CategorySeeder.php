<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Communiqués', 'color' => 'cat-orange'],
            ['name' => 'Événements', 'color' => 'cat-green'],
            ['name' => 'Programmes', 'color' => 'cat-blue'],
            ['name' => 'Investissement', 'color' => 'cat-orange'],
            ['name' => 'Témoignages', 'color' => 'cat-dark'],
            ['name' => 'Politique', 'color' => 'cat-blue'],
            ['name' => 'Bilan', 'color' => 'cat-dark'],
            ['name' => 'Forum', 'color' => 'cat-orange'],
            ['name' => 'Sensibilisation', 'color' => 'cat-green'],
            ['name' => 'Diaspora', 'color' => 'cat-green'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'color' => $cat['color'],
            ]);
        }
    }
}
