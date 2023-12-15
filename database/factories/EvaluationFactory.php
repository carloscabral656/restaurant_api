<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gastronomy>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'evaluation' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'comment' => ''
        ];
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
    */
    public function forPurchase(int $idPurchase)
    {
        return $this->state(function(array $attributes) use($idPurchase) {
            return [
                'id_purchase' => $idPurchase
            ];
        });
    }
}
