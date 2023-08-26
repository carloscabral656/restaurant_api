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
            "id_menu" => DB::table('menus')->first()->id,
            "name" => '', 
            "description" => '', 
            "img_item" => '',
            "unit_price" => 1,
            "discount" => 0
         ]);

        DB::table("items")->insert([
            "id_menu" => DB::table('menus')->first()->id,
            "name" => '', 
            "description" => '', 
            "img_item" => '',
            "unit_price" => 1,
            "discount" => 0 
        ]);

        DB::table("items")->insert([
            "id_menu" => DB::table('menus')->first()->id,
            "name" => '', 
            "description" => '', 
            "img_item" => '',
            "unit_price" => 1,
            "discount" => 0 
        ]);
    }
}
