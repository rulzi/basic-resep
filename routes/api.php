<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::get('/me', [AuthController::class, 'me'])->name('me');
});

Route::prefix('category')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{slug}', [CategoryController::class, 'show'])->name('show');
    Route::post('/{slug}', [CategoryController::class, 'update'])->name('update');
    Route::post('/{slug}/delete', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::prefix('ingredient')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [IngredientController::class, 'index'])->name('index');
    Route::post('/', [IngredientController::class, 'store'])->name('store');
    Route::get('/{slug}', [IngredientController::class, 'show'])->name('show');
    Route::post('/{slug}', [IngredientController::class, 'update'])->name('update');
    Route::post('/{slug}/delete', [IngredientController::class, 'destroy'])->name('destroy');
});

Route::prefix('recipe')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [RecipeController::class, 'index'])->name('index');
    Route::get('/{slug}', [RecipeController::class, 'show'])->name('show');
});
