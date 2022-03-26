<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Serializers\CustomSerializer;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function index()
    {
        $categories = Category::all();

        $transforms = fractal($categories, New CategoryTransformer(), New CustomSerializer())->toArray();

        $data = [
            'categories' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $transforms = fractal($category, New CategoryTransformer(), New CustomSerializer())->toArray();

        $data = [
            'category' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = New Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        $transforms = fractal($category, New CategoryTransformer(), New CustomSerializer())->toArray();

        $data = [
            'category' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::where('slug', $slug)->first();

        if(empty($category)){
            return $this->sendJson(null, 'error', 404, 'Not Found');
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        $transforms = fractal($category, New CategoryTransformer(), New CustomSerializer())->toArray();

        $data = [
            'category' => $transforms,
        ];

        return $this->sendJson($data);
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if(empty($category)){
            return $this->sendJson(null, 'error', 404, 'Not Found');
        }

        $category->delete();

        return $this->sendJson(null, 'Success Delete');
    }
}
