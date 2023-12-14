<?php

namespace Database\Seeders;

use App\Models\TypeItem;
use Illuminate\Database\Seeder;

class TypeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeItem::factory(6)->create();
    }
}
