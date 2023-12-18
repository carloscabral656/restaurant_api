<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TypeItemFactory extends Factory
{

    static $typeItens = [
        'Dish',
        'Drink'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        return [
            'description' => array_shift(self::$typeItens),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ];
    }
}
