<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SimpleState\Models\Investment;
use Tests\TestCase;

class InvestmentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_investment_model(): void
    {
        $model = Investment::factory()->create();

        $this->assertInstanceOf(Investment::class, $model);
    }
}
