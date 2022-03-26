<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Serializers\CustomSerializer;
use App\Transformers\RecipeTransformer;

class RecipeController extends ApiController
{
    public function index()
    {
        $recipes = Recipe::with(['category', 'details', 'details.ingredient'])->get();

        $transforms = fractal($recipes, New RecipeTransformer(), New CustomSerializer())
            ->parseIncludes(['ingredients'])
            ->toArray();

        $data = [
            'recipes' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function show($slug)
    {
        $recipe = Recipe::with(['category', 'details', 'details.ingredient'])->where('slug', $slug)->first();

        $transforms = fractal($recipe, New RecipeTransformer(), New CustomSerializer())
            ->parseIncludes(['ingredients'])
            ->toArray();

        $data = [
            'recipe' => $transforms,
        ];

        return $this->sendJson($data);
    }
}
