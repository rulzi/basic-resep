<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_category()
    {
        User::factory()->create();
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/category');

        $response->assertStatus(200);
    }

    public function test_create_category()
    {
        User::factory()->create();
        $user = User::find(1);

        $response = $this->actingAs($user)->post('/category', [
            'name' => 'Category',
            'description' => 'Category Description'
        ]);

        $response->assertStatus(302);
        $this->assertCount(1, Category::all());
    }

    public function test_put_category()
    {
        User::factory()->create();
        $user = User::find(1);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)->put('/category/'.$category->id, [
            'name' => 'Category',
            'description' => 'Category Description'
        ]);

        $response->assertStatus(302);

        $categorySave = Category::find($category->id);
        $this->assertEquals('Category', $categorySave->name);
    }

    public function test_delete_category()
    {
        User::factory()->create();
        $user = User::find(1);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)->delete('/category/'.$category->id);

        $response->assertStatus(302);

        $this->assertCount(0, Category::all());
    }
}
