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
        $randomRestaurantImage = ['restaurant_1.jpg', 'restaurant_2.jpg', 'restaurant_3.jpg', 'restaurant_4.jpg', 'restaurant_5.jpg'];

        $selectedGatronomy = Gastronomy::where('id', '=', $randomGastronomy)->first();

        return [
            'name'          => "{$this->faker->company()} Restaurant",
            'description'   => "The best {$selectedGatronomy->description} food!",
            'telephone'     => $this->faker->phoneNumber(),
            'id_gastronomy' => (int)$randomGastronomy,
            'id_restaurant_type' => (int)$randomRestaurantType,
            'img_restaurant'   => "/restaurants/{$this->faker->randomElement($randomRestaurantImage)}", // Image Name
            'id_owner' => 1,
            'id_address' => 1
        ];
    }
}
