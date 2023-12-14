<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TypeItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $typeItens = [
            'Met',
            'Chiken',
            'Pork',
            'Vegetable',
            'Fruit',
            'Drinks'
        ];
        return [
            'description' => array_shift($typeItens),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ];
    }
}
