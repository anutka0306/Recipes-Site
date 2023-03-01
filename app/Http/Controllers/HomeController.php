<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RecipesController;
use App\Http\Controllers\RecipeCategoryController;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(RecipeCategoryController $recipeCategoryController) {
        $this->categories = $recipeCategoryController->getAllCategories();
    }
    public function home(Request $request, RecipesController $recipesController, RecipeCategoryController $categoryController)
    {
        return view('home/index', [
            'recipes' => $recipesController->getAllRecipes(),
            'categories' => $this->categories,
        ]);
    }
}
