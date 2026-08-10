<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Jeux de société',
            'Consoles et jeux vidéo',
            'Poupées et figurines',
            'Peluches',
            'Jeux de construction',
            'Loisirs créatifs',
        ];

        foreach ($names as $name) {
            Category::updateOrCreate(['name' => $name]);
        }
    }
}
