<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gastronomy>
 */
class GastronomyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            [
                'name' => 'Arabic',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Brazilian',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Japonese',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Italian',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Thai',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'French',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'German',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'British',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Chinese',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Indian',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Korean',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Peruvian',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],

            [
                'name' => 'Vegetarian',
                'created_at' => (new Carbon())->now(),
                'updated_at' => (new Carbon())->now(),
            ],
        ];
    }
}
