<?php

namespace SimpleState\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use SimpleState\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'profit' => fake()->randomDigit(),
            'start_date' => now()->format("Y-m-d"),
            'end_date' => now()->addDays(10)->format("Y-m-d"),
            'created_at' => now()->format("Y-m-d"),
        ];
    }
}
