<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SimpleState\Models\Transaction;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_transaction_model(): void
    {
        $model = Transaction::factory()->create();

        $this->assertInstanceOf(Transaction::class, $model);
    }
}
