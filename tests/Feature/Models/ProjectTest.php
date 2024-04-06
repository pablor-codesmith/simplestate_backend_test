<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SimpleState\Models\Project;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_project_model(): void
    {
        $model = Project::factory()->create();

        $this->assertInstanceOf(Project::class, $model);
    }
}
