<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("category.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("category.create");
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

        $category = New Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if($category->save()){
            $request->session()->flash('success', "Berhasil Simpan");
        }

        return redirect(route('category.index'));
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
        $category = Category::find($id);

        $data = [
            "category" => $category,
        ];

        return view("category.edit", $data);
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

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;

        if($category->save()){
            $request->session()->flash('success', "Berhasil Update");
        }

        return redirect(route('category.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);

        if($category->delete()){
            $request->session()->flash('delete', "Berhasil Hapus");
        }

        return redirect(route('category.index'));
    }

    public function datatable(Request $request)
    {
        $categories = Category::query();
        
        return Datatables::of($categories)
                ->addColumn('action', function(Category $category) {
                    $data = [
                        "category" => $category,
                    ];
                    return view('category.datatable-action', $data);
                })
                ->make(true);
    }

    public function select2(Request $request)
    {
        $categories = Category::where('name', 'like', '%'.$request->search.'%')->get();
        
        return response()->json($categories);
    }
}
