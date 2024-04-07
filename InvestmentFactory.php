<?php

namespace SimpleState\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Enums\InvestmentStatusEnum;
use SimpleState\Models\Project;
use SimpleState\Models\Transaction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investment>
 */
class InvestmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomNumber(),
            'status' => InvestmentStatusEnum::getRandomValue(),
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'created_at' => now()->format('Y-m-d'),
            'transaction_id' => Transaction::factory(),
        ];
    }
}
