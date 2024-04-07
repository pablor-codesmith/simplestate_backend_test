<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Database\Eloquent\Factories\Sequence;
use SimpleState\Enums\InvestmentStatusEnum;
use SimpleState\Models\Investment;
use Tests\TestCase;

class SearchInvestmentControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_investment_list(): void
    {

        $user1 = User::factory()->has(Investment::factory(10), 'investments')->create();
        $user2 = User::factory()->has(Investment::factory(10), 'investments')->create();
        $user3 = User::factory()->has(Investment::factory(35), 'investments')->create();

        $response = $this->getJson(route('investment.list'));

        $response->assertSuccessful()
                ->assertJson(fn (AssertableJson $json) => $json->has('data')
                ->count('data', 3)
                ->etc());
    }

    /**
     * A basic feature test example.
     */
    public function test_investment_list_filter_by_status(): void
    {
        $user1 = User::factory()->has(Investment::factory(['status' => InvestmentStatusEnum::PENDING])->count(10), 'investments')->create();
        $user2 = User::factory()->has(Investment::factory(['status' => InvestmentStatusEnum::APPROVED])->count(15), 'investments')->create();
        $user3 = User::factory()->has(Investment::factory(['status' => InvestmentStatusEnum::FINISHED])->count(35), 'investments')->create();

        $response = $this->getJson(route('investment.list',['status' => InvestmentStatusEnum::FINISHED]));

        $response->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) => $json->has('data')
            ->count('data', 1)
            ->where('data.0.Cantidad', 35)
            ->etc());
    }
}
