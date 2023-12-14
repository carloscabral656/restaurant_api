<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $typeItens = [
            'Food',
            'Fried',
            'Health',
            'Drinks'
        ];
        return [
            'description' => array_shift($typeItens),
            'created_at'  => now(),
            'updated_at'  => now()
        ];
    }
}
