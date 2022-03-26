<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    
    public function test_example()
    {
        User::factory()->create();
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}
