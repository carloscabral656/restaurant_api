<?php

namespace Database\Seeders;

use App\Models\RestaurantType;
use Illuminate\Database\Seeder;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RestaurantType::factory(2)->create();
    }
}
