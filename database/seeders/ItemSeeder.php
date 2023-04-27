<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("items")->insert([
            "name" => "ITEM 1",
            "ide_menu" => 1
        ]);

        DB::table("items")->insert([
            "name" => "ITEM 2",
            "ide_menu" => 1
        ]);

        DB::table("items")->insert([
            "name" => "ITEM 3",
            "ide_menu" => 1
        ]);
    }
}
