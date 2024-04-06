<?php

namespace SimpleState\Database\Factories;

use SimpleState\Models\Operation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Enums\TransactionStatusEnum;
use SimpleState\Models\Transaction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomNumber(),
            'status' => TransactionStatusEnum::getRandomValue(),
            'user_id' => User::factory(),
            'operation_id' => Operation::factory(),
            'created_at' => now()->format('Y-m-d')
        ];
    }
}
