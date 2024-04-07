<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Constraint\Operator;
use SimpleState\Enums\OperationTypeEnum;
use SimpleState\Enums\TransactionStatusEnum;
use SimpleState\Models\Operation;
use SimpleState\Models\Transaction;
use Tests\TestCase;

class SearchTransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_transaction_list(): void
    {
        $operation1 = Operation::factory()->create(['name' => OperationTypeEnum::INVEST, 'operator' => '-']);
        $operation2 = Operation::factory()->create(['name' => OperationTypeEnum::DEPOSIT, 'operator' => '+']);
        $operation3 = Operation::factory()->create(['name' => OperationTypeEnum::WITHDRAWAL, 'operator' => '-']);

        $user1 = User::factory()->has(Transaction::factory(['status' => TransactionStatusEnum::PENDING, 'operation_id' => $operation1])->count(10), 'transactions')->create();
        $user2 = User::factory()->has(Transaction::factory(['status' => TransactionStatusEnum::REJECTED, 'operation_id' => $operation2, 'created_at' => now()->addDays(4)->format('Y-m-d')])->count(15), 'transactions')->create();
        $user3 = User::factory()->has(Transaction::factory(['status' => TransactionStatusEnum::APPROVED, 'operation_id' => $operation3])->count(35), 'transactions')->create();

        $response = $this->getJson(route('transaction.list'));
        $response->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) => $json->has('data')
                ->count('data', 15)
                ->where('total',61)
                ->etc());

        $response = $this->getJson(route('transaction.list',['user_id' => $user1->id]));
        $response->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) => $json->has('data')
                ->where('total', 10)
                ->etc());

        $response = $this->getJson(route('transaction.list', ['operation_id' => $operation3->id]));
        $response->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) => $json->has('data')
                ->where('total', 35)
                ->etc());

        $response = $this->getJson(route('transaction.list', ['created_at' => now()->addDays(4)->format('Y-m-d')]));
        $response->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) => $json->has('data')
                ->where('total', 15)
                ->etc());
    }
}
