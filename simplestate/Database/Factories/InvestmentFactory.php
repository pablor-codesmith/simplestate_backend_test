<?php

namespace SimpleState\Database\Factories;

use SimpleState\Models\Operation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Models\Investment;
use SimpleState\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investment>
 */
class InvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomNumber(),
            'status' => fake()->randomElement(['pending', 'finished', 'approved']),
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'created_at' => now()->format('Y-m-d')
        ];
    }
}
