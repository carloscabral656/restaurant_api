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

        $randomGastronomy = rand(1, Gastronomy::count());
        $randomRestaurantType = rand(1, RestaurantType::count());

        return [
            'name'          => "{$this->faker->name()} Restaurant",
            'description'   => 'The best food of',
            'id_gastronomy' => (int)$randomGastronomy,
            'id_restaurant_type' => (int)$randomRestaurantType,
            'image_restaurant' => null,
            'id_owner' => 1,
            'id_address' => 1
        ];
    }
}
