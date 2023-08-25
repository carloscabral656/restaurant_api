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
            "unit_price" => '',
            "discount" => ''
         ]);

        DB::table("items")->insert([
            "name" => "ITEM 2",
            "id_menu" => DB::table('menus')->first()->id  
        ]);

        DB::table("items")->insert([
            "name" => "ITEM 3",
            "id_menu" => DB::table('menus')->first()->id  
        ]);
    }
}
