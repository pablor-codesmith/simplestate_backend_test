<?php

namespace Tests\Unit;

use App\Models\User;
use SimpleState\Enums\TransactionStatusEnum;
use SimpleState\Models\AccountBank;
use SimpleState\Models\Transaction;
use Tests\TestCase;
use SimpleState\Services\DebinManager;

class DebinServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_debin(): void
    {
        $user = User::factory()->create();
        $account_bank = AccountBank::factory(['user_id'=>$user->id,'cbu'=> "3220001822000055910031"])->create();
        $transaction = Transaction::factory(['user_id' => $user->id,'amount' => 10, 'status' => TransactionStatusEnum::PENDING])->create();

        $debinManager = new DebinManager();
        $token = $debinManager->createDebin(322, "21-1-99999-4-6", $account_bank->cbu, $transaction->amount, $transaction->id);
        $this->assertNotNull($token);
    }
}
