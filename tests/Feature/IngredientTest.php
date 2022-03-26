<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    use DatabaseMigrations;

    public function test_ingredient()
    {
        User::factory()->create();
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/ingredient');

        $response->assertStatus(200);
    }

    public function test_create_ingredient()
    {
        User::factory()->create();
        $user = User::find(1);

        $response = $this->actingAs($user)->post('/ingredient', [
            'name' => 'Ingredient',
            'description' => 'Ingredient Description'
        ]);

        $response->assertStatus(302);
        $this->assertCount(1, Ingredient::all());
    }

    public function test_put_ingredient()
    {
        User::factory()->create();
        $user = User::find(1);

        $ingredient = Ingredient::factory()->create();

        $response = $this->actingAs($user)->put('/ingredient/'.$ingredient->id, [
            'name' => 'Ingredient',
            'description' => 'Ingredient Description'
        ]);

        $response->assertStatus(302);

        $ingredientSave = Ingredient::find($ingredient->id);
        $this->assertEquals('Ingredient', $ingredientSave->name);
    }

    public function test_delete_ingredient()
    {
        User::factory()->create();
        $user = User::find(1);

        $ingredient = Ingredient::factory()->create();

        $response = $this->actingAs($user)->delete('/ingredient/'.$ingredient->id);

        $response->assertStatus(302);

        $this->assertCount(0, Ingredient::all());
    }
}
