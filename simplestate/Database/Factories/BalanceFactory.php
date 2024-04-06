<?php

namespace SimpleState\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Models\Balance;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Balance::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomNumber(),
            'user_id' => User::factory(),
            'created_at' => now()->format('Y-m-d')
        ];
    }
}
