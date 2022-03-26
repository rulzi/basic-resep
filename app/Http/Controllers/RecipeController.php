<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use Yajra\Datatables\Datatables;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("recipe.index");
    }

    public function pagination(Request $request)
    {
        $recipes = Recipe::with(['category', 'details', 'details.ingredient']);

        if(!empty($request->category_id)){
            $recipes = $recipes->where('category_id', $request->category_id);
        }
        
        if(!empty($request->ingredient_id)){
            $recipes = $recipes->whereHas('details', function ($query) use ($request) {
                return $query->where('ingredient_id', $request->ingredient_id);
            });
        }

        $recipes = $recipes->paginate(10);

        $categories = Category::all();
        $ingredients = Ingredient::all();

        $data = [
            'recipes' => $recipes,
            'categories' => $categories,
            'ingredients' => $ingredients,
        ];

        return view("recipe.paginate", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("recipe.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'category_id' => ['required'],
        ]);

        $recipe = New Recipe();
        $recipe->category_id = $request->category_id;
        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->save();

        if(count($request->ingredient_id) > 0){
            foreach($request->ingredient_id as $key => $ingredient){
                $ingredient_recipe = New RecipeIngredient();

                $ingredient_recipe->recipe_id = $recipe->id;
                $ingredient_recipe->ingredient_id = $request->ingredient_id[$key];
                $ingredient_recipe->amount = $request->amount[$key];
                $ingredient_recipe->save();
            }
        }

        $request->session()->flash('success', "Berhasil Simpan");

        return redirect(route('recipe.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::with(['category', 'details', 'details.ingredient'])->find($id);

        $data = [
            "recipe" => $recipe,
        ];

        return view("recipe.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required'],
        ]);

        $recipe = Recipe::find($id);
        $recipe->category_id = $request->category_id;
        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->save();

        RecipeIngredient::where('recipe_id', $recipe->id)->delete();
        if(count($request->ingredient_id) > 0){
            foreach($request->ingredient_id as $key => $ingredient){
                $ingredient_recipe = New RecipeIngredient();

                $ingredient_recipe->recipe_id = $recipe->id;
                $ingredient_recipe->ingredient_id = $request->ingredient_id[$key];
                $ingredient_recipe->amount = $request->amount[$key];
                $ingredient_recipe->save();
            }
        }

        $request->session()->flash('success', "Berhasil Update");

        return redirect(route('recipe.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $recipe = Recipe::find($id);

        if($recipe->delete()){
            $request->session()->flash('delete', "Berhasil Hapus");
        }

        return redirect(route('recipe.index'));
    }

    public function datatable(Request $request)
    {
        $recipes = Recipe::query()
            ->with(['details', 'details.ingredient'])
            ->leftJoin('categories', 'categories.id', '=', 'recipes.category_id')
            ->leftJoin('recipe_ingredients', 'recipe_ingredients.recipe_id', '=', 'recipes.id')
            ->leftJoin('ingredients', 'recipe_ingredients.ingredient_id', '=', 'ingredients.id')
            ->groupBy('recipes.id')
            ->select('recipes.*', 'categories.name as category');

        return Datatables::of($recipes)
                ->addColumn('action', function(Recipe $recipe) {
                    $data = [
                        "recipe" => $recipe,
                    ];
                    return view('recipe.datatable-action', $data);
                })
                ->addColumn('ingredients', function(Recipe $recipe) {
                    $data = [
                        "recipe" => $recipe,
                    ];

                    return view('recipe.datatable-list', $data);
                })
                ->make(true);
    }

    public function select2(Request $request)
    {
        $recipes = Recipe::where(function($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('code', 'like', '%'.$request->search.'%');
                })->get();
        
        return response()->json($recipes);
    }
}
