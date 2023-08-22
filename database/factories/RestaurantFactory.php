<?php

namespace Database\Factories;

use App\Models\Gastronomy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'id_gastronomy' => 1,
            'id_restaurant_type' => 1,
            'id_owner' => 1,
            'id_address' => 1
        ];
    }
}
