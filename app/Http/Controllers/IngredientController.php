<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Yajra\Datatables\Datatables;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("ingredient.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ingredient.create");
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
        ]);

        $ingredient = New Ingredient();
        $ingredient->name = $request->name;
        $ingredient->description = $request->description;

        if($ingredient->save()){
            $request->session()->flash('success', "Berhasil Simpan");
        }

        return redirect(route('ingredient.index'));
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
        $ingredient = Ingredient::find($id);

        $data = [
            "ingredient" => $ingredient,
        ];

        return view("ingredient.edit", $data);
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

        $ingredient = Ingredient::find($id);
        $ingredient->name = $request->name;
        $ingredient->description = $request->description;

        if($ingredient->save()){
            $request->session()->flash('success', "Berhasil Update");
        }

        return redirect(route('ingredient.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $ingredient = Ingredient::find($id);

        if($ingredient->delete()){
            $request->session()->flash('delete', "Berhasil Hapus");
        }

        return redirect(route('ingredient.index'));
    }

    public function datatable(Request $request)
    {
        $ingredients = Ingredient::query();
        
        return Datatables::of($ingredients)
                ->addColumn('action', function(Ingredient $ingredient) {
                    $data = [
                        "ingredient" => $ingredient,
                    ];
                    return view('ingredient.datatable-action', $data);
                })
                ->make(true);
    }

    public function select2(Request $request)
    {
        $ingredients = Ingredient::where('name', 'like', '%'.$request->search.'%')->get();
        
        return response()->json($ingredients);
    }
}
