<?php

namespace Database\Seeders;

use App\Models\Gastronomy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GastronomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("gastronomies")->insert([
            'description' => "ITALIAN"
        ]);

        DB::table("gastronomies")->insert([
            'description' => "FRENCH"
        ]);
    }
}
