<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{

    protected static $initialized = false;
    protected static $restaurants = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        if (!self::$initialized) {
            self::$restaurants = Restaurant::pluck('id');
            self::$initialized = true;
        }

        $restaurant = (int)self::$restaurants->shift();

        return [
            "id_restaurant" => $restaurant,
            "name" => "Menu's Chef"
        ];
    }
}
