<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = [
            [
                'name' => 'Nasi Goreng',
                'slug' => 'nasi-goreng',
                'description' => 'Nasi Goreng',
                'category_id' => 1,
            ],
        ];
        DB::table('recipes')->insert($recipes);

        $recipeIngredients = [
            [
                'recipe_id' => 1,
                'ingredient_id' => 1,
                'amount' => 'Satu Piring',
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 2,
                'amount' => 'Dua Butir',
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 3,
                'amount' => 'Secukupnya',
            ],
        ];
        DB::table('recipe_ingredients')->insert($recipeIngredients);
    }
}
