<?php

namespace Tests\Feature\Models;

use SimpleState\Models\Operation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OperationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_operation_model(): void
    {
        $model = Operation::factory()->create();

        $this->assertInstanceOf(Operation::class, $model);
    }
}
