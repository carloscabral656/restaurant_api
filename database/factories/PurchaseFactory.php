<?php

namespace Database\Factories;

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

        return [
            "id_user"              => $users->random(),
            "total_descount_items" => '',
            "descount_purchase"    => '',
            "total_gross_purchase" => '',
            "total_net_purchase"   => ''
        ];
    }
}
