<?php

namespace Tests\Feature\Jobs;

use App\Jobs\CreateDebinJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SimpleState\Enums\TransactionStatusEnum;
use SimpleState\Models\Transaction;
use Tests\TestCase;

class CreateDebinJobTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_debin_job(): void
    {
        $transaction = Transaction::factory(['amount' => 10, 'status' => TransactionStatusEnum::PENDING])->create();

        CreateDebinJob::dispatchSync($transaction);

        $transaction->refresh();

        $this->assertNotEmpty($transaction->debin_id);
    }
}
