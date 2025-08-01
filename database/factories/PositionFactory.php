<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Position;

class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Position::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->text(),
            'status' => fake()->randomElement(['open', 'closed']),
            'max_applicants' => fake()->randomNumber(2),
        ];
    }
}
