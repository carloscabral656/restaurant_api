<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory(2)->create();
        User::factory(2)->create();

        User::create([
            'name' => 'Frederico',
            'email' => "fred@graodireto.com.br",
            'password' => Hash::make("123Fred"),
            'id_address' => 1
        ]);
    }
}
