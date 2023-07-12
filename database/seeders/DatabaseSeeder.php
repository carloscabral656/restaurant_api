<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RestaurantType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            GastronomySeeder::class,
            RestaurantTypeSeeder::class,
            RestaurantSeeder::class,
            MenuSeeder::class,
            ItemSeeder::class,
            PurchaseSeeder::class
        ]); 
    }
}
