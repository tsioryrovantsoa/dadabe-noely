<?php

namespace Database\Factories;

use App\Models\Child;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Child>
 */
class ChildFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'birth_year' => fake()->numberBetween(now()->year - 18, now()->year - 4),
            'contact' => fake()->numerify('034 ## ### ##'),
            'bonus_points' => fake()->randomElement(Child::BONUS_POINT_LEVELS),
        ];
    }
}
