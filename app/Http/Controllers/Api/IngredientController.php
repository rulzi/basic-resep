<?php

namespace App\Http\Controllers\Api;

use App\Models\Ingredient;
use App\Serializers\CustomSerializer;
use App\Transformers\IngredientTransformer;
use Illuminate\Http\Request;

class IngredientController extends ApiController
{
    public function index()
    {
        $ingredients = Ingredient::all();

        $transforms = fractal($ingredients, New IngredientTransformer(), New CustomSerializer())->toArray();

        $data = [
            'ingredients' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function show($slug)
    {
        $ingredient = Ingredient::where('slug', $slug)->first();

        $transforms = fractal($ingredient, New IngredientTransformer(), New CustomSerializer())->toArray();

        $data = [
            'ingredient' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $ingredient = New Ingredient();
        $ingredient->name = $request->name;
        $ingredient->description = $request->description;
        $ingredient->save();

        $transforms = fractal($ingredient, New IngredientTransformer(), New CustomSerializer())->toArray();

        $data = [
            'ingredient' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $ingredient = Ingredient::where('slug', $slug)->first();

        if(empty($ingredient)){
            return $this->sendJson(null, 'error', 404, 'Not Found');
        }

        $ingredient->name = $request->name;
        $ingredient->description = $request->description;
        $ingredient->save();

        $transforms = fractal($ingredient, New IngredientTransformer(), New CustomSerializer())->toArray();

        $data = [
            'ingredient' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function destroy($slug)
    {
        $ingredient = Ingredient::where('slug', $slug)->first();

        if(empty($ingredient)){
            return $this->sendJson(null, 'error', 404, 'Not Found');
        }

        $ingredient->delete();

        return $this->sendJson(null, 'Success Delete');
    }
}
