<?php

namespace Database\Seeders;

use App\Models\Gastronomy;
use Illuminate\Database\Seeder;

class GastronomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gastronomy::factory(2)->create();
    }
}
