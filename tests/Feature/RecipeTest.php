<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use DatabaseMigrations;

    public function test_recipe()
    {
        User::factory()->create();
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/recipe');

        $response->assertStatus(200);
    }

    public function test_create_recipe()
    {
        User::factory()->create();
        $user = User::find(1);

        $category = Category::factory()->create();
        $ingredient = Ingredient::factory()->create();

        $response = $this->actingAs($user)->post('/recipe', [
            'name' => 'Recipe',
            'description' => 'Recipe Description',
            'category_id' => $category->id,
            'ingredient_id' => [$ingredient->id],
            'amount' => ['secukupnya'],
        ]);

        $response->assertStatus(302);
        $this->assertCount(1, Recipe::all());
    }

    public function test_put_recipe()
    {
        User::factory()->create();
        $user = User::find(1);

        $category = Category::factory()->create();
        $ingredient = Ingredient::factory()->create();
        $recipe = Recipe::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->put('/recipe/'.$recipe->id, [
            'name' => 'Recipe',
            'description' => 'Recipe Description',
            'category_id' => $category->id,
            'ingredient_id' => [$ingredient->id],
            'amount' => ['secukupnya'],
        ]);

        $response->assertStatus(302);

        $recipeSave = Recipe::find($recipe->id);
        $this->assertEquals('Recipe', $recipeSave->name);
    }

    public function test_delete_recipe()
    {
        User::factory()->create();
        $user = User::find(1);

        $category = Category::factory()->create();
        $recipe = Recipe::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->delete('/recipe/'.$recipe->id);

        $response->assertStatus(302);

        $this->assertCount(0, Recipe::all());
    }
}
