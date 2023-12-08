<?php

namespace Database\Factories;

use App\Models\Gastronomy;
use App\Models\RestaurantType;
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
            'id_gastronomy' => function() {
                return Gastronomy::where('description', 'like', '%Italian%');
            },
            'id_restaurant_type' => function() {
                return RestaurantType::where('description', 'like', '%Pastas%');
            },
            'id_owner' => 1,
            'id_address' => 1
        ];
    }
}
