<?php

namespace Tests\Feature\Http\Controllers;

use App\Jobs\CreateDebinJob;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use SimpleState\Enums\OperationTypeEnum;
use SimpleState\Models\Investment;
use SimpleState\Models\Operation;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;

class CreateInvestmentControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_investment(): void
    {
        Queue::fake();

        Operation::factory()->create(['name' => OperationTypeEnum::INVEST, 'operator' => '+']);
        /** @var Array $investment */
        $investment = Investment::factory()->make()->only(['amount','project_id','user_id']);
        $response = $this->postJson(route('investment.create'),$investment);
        $response->assertCreated()
                 ->assertJson(fn (AssertableJson $json) => $json->where('amount', $investment['amount'])
                            ->where('user_id', $investment['user_id'])
                            ->where('project_id',$investment['project_id'])
                            ->has('transaction')
                            ->where('transaction.amount',$investment['amount'])
                            ->where('transaction.user_id',$investment['user_id'])
                            ->etc());

        Queue::assertPushed(CreateDebinJob::class);
    }

    /**
     * A basic feature test example.
     */
    public function test_fail_create_investment(): void
    {
        /** @var Array $investment */
        $investment = Investment::factory()->make(['amount' => -1, 'project_id' => -1, 'user_id' => -1])->toArray();
        $response = $this->postJson(route('investment.create'), $investment);
        $response->assertInvalid(['amount','project_id','user_id']);
    }
}
