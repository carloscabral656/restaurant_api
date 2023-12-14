<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            AddressSeeder::class,
            UserSeeder::class,
            GastronomySeeder::class,
            RestaurantTypeSeeder::class,
            RestaurantSeeder::class,
            MenuSeeder::class,
            TypeItemSeeder::class,
            ItemSeeder::class,
            PurchaseSeeder::class
        ]);
    }
}
