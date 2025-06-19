<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\JobApplication;
use App\Models\Position;

class JobApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApplication::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'position_id' => Position::all()->random()->id,
            'applicant_user_id' => User::all()->random()->id,
            'date' => fake()->dateTime(),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected'])
        ];
    }
}
