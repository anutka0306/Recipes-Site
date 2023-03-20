<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoryController;



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

Route::get('/', [HomeController::class, 'home']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::post('ingredient/find', [IngredientsController::class, 'findIngredient']);
Route::post('recipe_name/find', [RecipesController::class, 'findRecipeByName']);
Route::get('recipe/{recipe}', [RecipesController::class, 'showRecipe'])->name('recipe');
Route::post('recipes/search', [RecipesController::class, 'searchRecipes'])->name('search-recipes');
Route::get('recipes/category/{category}', [RecipesController::class, 'showRecipesByCategory'])->name('category-recipes');
Route::get('post/{post}', [PostsController::class, 'showPost'])->name('post');
Route::get('blog', [PostsController::class, 'getAllPosts'])->name('blog');
Route::get('blog/{category}', [CategoryController::class, 'showCategory'])->name('category');
