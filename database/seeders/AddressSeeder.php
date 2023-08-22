<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'address' => 'Teste 1',
            'neighborhood' => 'teste 1',
            'number' => 111,
            'city' => 'Ube',
            'state' => 'MG',
            'created_at' => now(),
            'updated_at' =>  now()
        ]);
    }
}
