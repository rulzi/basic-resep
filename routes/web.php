<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name("home");

Route::name("profile.")->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
});

Route::name("user.")->prefix('user')->group(function () {
    Route::get('/datatable', [UserController::class, 'datatable'])->name('datatable');
});
Route::resource('user', UserController::class);

Route::name("category.")->prefix('category')->group(function () {
    Route::get('/datatable', [CategoryController::class, 'datatable'])->name('datatable');
    Route::get('/select2', [CategoryController::class, 'select2'])->name('select2');
});
Route::resource('category', CategoryController::class);

Route::name("ingredient.")->prefix('ingredient')->group(function () {
    Route::get('/datatable', [IngredientController::class, 'datatable'])->name('datatable');
    Route::get('/select2', [IngredientController::class, 'select2'])->name('select2');
});
Route::resource('ingredient', IngredientController::class);

Route::name("recipe.")->prefix('recipe')->group(function () {
    Route::get('/pagination', [RecipeController::class, 'pagination'])->name('pagination');
    Route::get('/datatable', [RecipeController::class, 'datatable'])->name('datatable');
    Route::get('/select2', [RecipeController::class, 'select2'])->name('select2');
});
Route::resource('recipe', RecipeController::class);
