<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RecipesController;
use App\Http\Controllers\RecipeCategoryController;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     * @param \App\Http\Controllers\RecipeCategoryController $recipeCategoryController
     */
    public function __construct(RecipeCategoryController $recipeCategoryController) {
        $this->categories = $recipeCategoryController->getAllCategories();
    }

    /**
     * @param Request $request
     * @param \App\Http\Controllers\RecipesController $recipesController
     * @param \App\Http\Controllers\RecipeCategoryController $categoryController
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function home(Request $request, RecipesController $recipesController, RecipeCategoryController $categoryController)
    {
        return view('home/index', [
            'recipes' => $recipesController->getAllRecipes(),
            'categories' => $this->categories,
            'latestRecipes' => $recipesController->getLatestRecipes(5),
        ]);
    }
}
