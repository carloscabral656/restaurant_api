<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use App\Models\Purchase;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purchases = Purchase::all();
        $purchases->map(function($purchase){
            Evaluation::factory(1)->forPurchase($purchase->id)->create();
        });
    }
}
