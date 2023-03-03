<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Http\Controllers\RecipeCategoryController;

class RecipesController extends Controller
{
    const DIFFICULTY = array(
       "1" => "easy",
       "2" => "medium",
        "3" => "complex"
    );
    public Recipe $recipe;
    public function __construct(Recipe $recipe, RecipeCategoryController $recipeCategoryController) {
        $this->recipe = $recipe;
        $this->categories = $recipeCategoryController->getAllCategories();
    }

    public function findRecipeByName(Request $request, Recipe $recipe){
        if(!empty($request->q)){
            $result = $recipe->getRecipesByName($request->q);
            echo $result;
        }
        return false;
    }

    public function getAllRecipes(){
        $recipes = $this->recipe->getAllRecipes();
        foreach ($recipes as $recipe){
            $time = $recipe->time;
            $time_parts = explode(':', $time);
            $recipe->hours = (int)$time_parts[0];
            $recipe->minutes = (int)$time_parts[1];
            $recipe->difficulty = self::DIFFICULTY[$recipe->difficulty];
        }
        return $recipes;
    }

    public function showRecipe(Recipe $recipe){
        $recipe = $this->recipe->getRecipeById($recipe->id);
        $time = $recipe->time;
        $time_parts = explode(':', $time);
        $recipe->hours = (int)$time_parts[0];
        $recipe->minutes = (int)$time_parts[1];
        $recipe->difficulty = self::DIFFICULTY[$recipe->difficulty];
        return view('recipe/index', [
            'recipe' => $recipe,
            'categories' => $this->categories,
        ]);
    }

    public function searchRecipes(Request $request, RecipeCategoryController $recipeCategoryController) {

        $recipes = null;
        if($request->has('category')) {
            $category = $request->category;
        }
        if($request->has('ingredient')) {
            $ingredient = $request->ingredient;
        }
        if($request->has('recipe_name')) {
            $recipeName = trim($request->recipe_name);
        }

        if(isset($recipeName) && isset($category) && isset($ingredient) && $recipeName != '' && $category != '' && $ingredient != ''){
            $recipes = $this->recipe->searchRecipesByNameIngredientCategory($recipeName, $ingredient, $category);
        }
        elseif (isset($recipeName) && isset($category) && $recipeName != '' && $category != ''){
            $recipes = $this->recipe->searchRecipesByCategoryAndName($category, $recipeName);
        }
        elseif (isset($recipeName) && isset($ingredient) && $recipeName != '' && $ingredient != ''){
            $recipes = $this->recipe->searchRecipesByNameAndIngredient($recipeName, $ingredient);
        }
        elseif (isset($category) && isset($ingredient) && $category != '' && $ingredient != ''){
            $recipes = $this->recipe->searchRecipesByCategoryAndIngredient($category, $ingredient);
        }
        elseif(isset($recipeName) && $recipeName != ''){
            $recipes = $this->recipe->searchRecipesByName($recipeName);
        }
        elseif(isset($category) && $category != ''){
            $recipes = $this->recipe->searchRecipesByCategory($category);
        }
        elseif(isset($ingredient) && $ingredient != '') {
            $recipes = $this->recipe->searchRecipesByIngredient($ingredient);
        }
        return view('search/recipes',[
            'recipes' => $recipes,
            'categories' => $this->categories,
        ]);
    }

    public function showRecipesByCategory(Request $request, RecipeCategoryController $recipeCategoryController) {
        $category_alias = $request->category;
        $current_category = $recipeCategoryController->getCategoryByAlias($category_alias);
        $recipes = $this->recipe->getRecipesByCatName($category_alias);
        return view('recipe.category',[
           'recipes' => $recipes,
           'categories' => $this->categories,
            'current_category' => $current_category,
        ]);
    }
}
