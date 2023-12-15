<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Menu;
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
        $menus = Menu::all();
        $qtItemPerMenu = 10;
        $menus->map(function($menu) use($qtItemPerMenu) {
            Item::factory($qtItemPerMenu)->withCustomMenu($menu->id)->create();
        });
    }
}
