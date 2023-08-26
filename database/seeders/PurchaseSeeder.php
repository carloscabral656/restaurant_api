<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("purchases")->insert([
            "id_user" =>  DB::table('users')->first()->id,
            "id_item" =>  DB::table('items')->first()->id
        ]);
    }
}
