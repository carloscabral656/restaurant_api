<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gastronomy>
 */
class GastronomyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gastronomies = [
            'Arabic', 'Brazilian', 'Japanese', 'Italian', 'Thai', 'French', 'German', 'British',
            'Chinese', 'Indian', 'Korean', 'Peruvian', 'Vegetarian'
        ];

        return [
            'description' => $this->faker->unique()->randomElement($gastronomies),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
