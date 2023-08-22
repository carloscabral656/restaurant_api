<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert([
            'description' => 'OWNER',
            'created_at'  => date("Y-m-d H:i:s"),
            'updated_at'  => date("Y-m-d H:i:s")
        ]);

        DB::table('roles')->insert([
            'description' => 'CLIENT',
            'created_at'  => date("Y-m-d H:i:s"),
            'updated_at'  => date("Y-m-d H:i:s")
        ]);
    }
}
