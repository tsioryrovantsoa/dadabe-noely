<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gift;
use Illuminate\Database\Seeder;

class GiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $giftsByCategory = [
            'Jeux de société' => [
                ['Monopoly Classique', 40],
                ['Uno', 15],
                ['Cluedo', 45],
                ['Puissance 4', 30],
                ['Jeu de dames en bois', 25],
            ],
            'Consoles et jeux vidéo' => [
                ['PlayStation 5', 150],
                ['Nintendo Switch OLED', 140],
                ['Mario Kart 8 Deluxe', 60],
                ['Manette sans fil', 50],
                ['Casque de jeu', 45],
            ],
            'Poupées et figurines' => [
                ['Barbie Aventurière', 30],
                ['Poupée Chelsea', 20],
                ['Figurine Spider-Man', 25],
                ['Château de princesse', 90],
                ['Coffret figurines dinosaures', 35],
            ],
            'Peluches' => [
                ['Ours en peluche géant', 55],
                ['Peluche licorne', 25],
                ['Peluche renard', 20],
                ['Peluche panda', 30],
                ['Coussin peluche étoile', 15],
            ],
            'Jeux de construction' => [
                ['LEGO City Caserne de pompiers', 80],
                ['LEGO Friends Maison', 65],
                ['LEGO Technic Voiture de course', 120],
                ['Circuit de train en bois', 70],
                ['Briques magnétiques', 45],
            ],
            'Loisirs créatifs' => [
                ['Chevalet de peinture', 60],
                ['Kit de bracelets', 25],
                ['Kit de perles', 20],
                ['Set de coloriage géant', 18],
                ['Pâte à modeler', 15],
            ],
        ];

        foreach ($giftsByCategory as $categoryName => $gifts) {
            $category = Category::where('name', $categoryName)->firstOrFail();

            foreach ($gifts as [$name, $points]) {
                Gift::updateOrCreate(
                    ['name' => $name],
                    [
                        'category_id' => $category->id,
                        'points' => $points,
                        'image' => 'https://placehold.co/600x400/1f5138/fdf5e9?text='.urlencode($name),
                    ],
                );
            }
        }
    }
}
