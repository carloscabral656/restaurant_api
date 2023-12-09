<?php

namespace Database\Factories;

use App\Models\Gastronomy;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{

    /**
     * 
     * 
    */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "{$this->faker->name()} Restaurant",
            'id_gastronomy' => function() {
                return Gastronomy::where('description', 'like', '%Italian%')->first()->id ?? 1;
            },
            'id_restaurant_type' => function() {
                return RestaurantType::where('description', 'like', '%Pasta%')->first()->id ?? 1;
            },
            'image_restaurant' => null,
            'id_owner' => 1,
            'id_address' => 1
        ];
    }
}
