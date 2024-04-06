<?php

namespace SimpleState\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Models\AccountBank;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountBank>
 */
class AccountBankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = AccountBank::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_name' => fake()->name(),
            'cbu' => fake()->randomNumber(8),
            'user_id' => User::factory()
        ];
    }
}
