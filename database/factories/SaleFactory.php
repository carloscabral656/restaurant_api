<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $discount = rand(1, 10);
        return [
            'description' => 'Test Sale',
            'discount'    => $discount,
            'begin_at'    => Carbon::now(),
            'end_at'      => Carbon::now()->addDays(200)
        ];
    }
}
