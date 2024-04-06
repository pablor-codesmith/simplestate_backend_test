<?php

namespace SimpleState\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Models\Operation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operation>
 */
class OperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Operation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'operator' => fake()->randomElement(['+','-']),
        ];
    }
}
