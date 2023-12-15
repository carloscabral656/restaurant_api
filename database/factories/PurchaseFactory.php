<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all()->pluck('id');
        $restaurants = Restaurant::all()->pluck('id');

        return [
            "id_user" => $users->random(),
            "id_restaurant" => $restaurants->random(),
            "total_descount_items" => 1,
            "descount_purchase"    => 1,
            "total_gross_purchase" => 1,
            "total_net_purchase"   => 1
        ];
    }
}
