<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SimpleState\Models\AccountBank;
use Tests\TestCase;

class AccountBankTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_account_bank_model(): void
    {
        $model = AccountBank::factory()->create();

        $this->assertInstanceOf(AccountBank::class, $model);
    }
}
