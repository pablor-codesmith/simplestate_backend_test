<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SimpleState\Models\Balance;
use Tests\TestCase;

class BalanceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_balance_model(): void
    {
        $model = Balance::factory()->create();

        $this->assertInstanceOf(Balance::class, $model);
    }
}
