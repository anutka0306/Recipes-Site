<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recipe extends Model
{
    use HasFactory;

    public function recipe_cat()
    {
        return $this->belongsTo(RecipeCategory::class, 'recipe_cat_id', 'id');
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function getRecipesByName($q){
        $recipes = Recipe::where('name', 'LIKE', "%{$q}%")->get();
        return $recipes;
    }

    public function getAllRecipes() {
        $recipes = Recipe::paginate(10);
        foreach ($recipes as $recipe){
            $steps = DB::table('steps')
                ->where('recipe_id', '=', $recipe->id)->orderBy('step_num', 'ASC')
                ->get();
            $recipe->steps = $steps;

            $ingredients = DB::table('ingredients_lists')
                ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
                ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
                ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
                ->where('ingredients_lists.recipe_id', '=', $recipe->id)
                ->get();
            $recipe->ingredients = $ingredients;
        }
        return $recipes;
    }

    public function getLatestRecipes($count) {
        return Recipe::with('recipe_cat')->limit($count)->get();
    }

    public function getFlexBannerRecipes() {
        return Recipe::where('is_flex_banner', 1)
            ->where('banner_photo', '!=', null)
            ->orderBy('banner_order')
            ->limit(5)
            ->get();
    }

    public function getCookNowRecipe() {
        return Recipe::where('banner_photo', '!=', null)
            ->inRandomOrder()
            ->limit(1)
            ->get();
    }

    public function getRecipesByCatName($alias){
        $cat_id = RecipeCategory::select('id')->where('alias', $alias)->first()->id;
        return $this->searchRecipesByCategory($cat_id);
    }

    public function searchRecipesByName($name) {
        $recipes = $this->getRecipesByName($name);
        foreach ($recipes as $recipe){
            $ingredients = DB::table('ingredients_lists')
                ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
                ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
                ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
                ->where('ingredients_lists.recipe_id', '=', $recipe->id)
                ->get();
            $recipe->ingredients = $ingredients;
        }
        return $recipes;
    }

    public function searchRecipesByCategory($cat_id) {
        $recipes = Recipe::where('recipe_cat_id', '=', $cat_id)->paginate(10);
        foreach ($recipes as $recipe){
            $ingredients = DB::table('ingredients_lists')
                ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
                ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
                ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
                ->where('ingredients_lists.recipe_id', '=', $recipe->id)
                ->get();
            $recipe->ingredients = $ingredients;
        }
        return $recipes;
    }

    public function searchRecipesByIngredient($ingredientName) {
        $ingredient = DB::table('ingredients')->select('id')->where('name', '=', $ingredientName)->first();
        if(!empty($ingredient)){
            $ingredient_id = $ingredient->id;
            $recipes_ids = DB::table('ingredients_lists')
                ->select('recipe_id')
                ->where('ingredient_id', '=', $ingredient_id)
                ->get();
            $ids = array();
            foreach ($recipes_ids as $id) {
                $ids[] = $id->recipe_id;
            }
            $recipes = Recipe::whereIn('id', $ids)->get();
            foreach ($recipes as $recipe){
                $ingredients = DB::table('ingredients_lists')
                    ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
                    ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
                    ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
                    ->where('ingredients_lists.recipe_id', '=', $recipe->id)
                    ->get();
                $recipe->ingredients = $ingredients;
            }
            return $recipes;
        }
        return null;

    }

    public function searchRecipesByCategoryAndName($category, $name){
        $recipes = Recipe::where('recipe_cat_id', '=', $category)
            ->where('name', 'LIKE', "%{$name}%")
            ->get();
        foreach ($recipes as $recipe){
            $ingredients = DB::table('ingredients_lists')
                ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
                ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
                ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
                ->where('ingredients_lists.recipe_id', '=', $recipe->id)
                ->get();
            $recipe->ingredients = $ingredients;
        }
        return $recipes;
    }

    public function searchRecipesByCategoryAndIngredient($category, $ingredientName){
        $ingredient = DB::table('ingredients')->select('id')->where('name', '=', $ingredientName)->first();
        if(!empty($ingredient)){
            $ingredient_id = $ingredient->id;
            $recipes_ids = DB::table('ingredients_lists')
                ->select('recipe_id')
                ->where('ingredient_id', '=', $ingredient_id)
                ->get();
            $ids = array();
            foreach ($recipes_ids as $id) {
                $ids[] = $id->recipe_id;
            }
            $recipes = Recipe::whereIn('id', $ids)
                ->where('recipe_cat_id', '=', $category)
                ->get();
            foreach ($recipes as $recipe){
                $ingredients = DB::table('ingredients_lists')
                    ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
                    ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
                    ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
                    ->where('ingredients_lists.recipe_id', '=', $recipe->id)
                    ->get();
                $recipe->ingredients = $ingredients;
            }
            return $recipes;
        }
        return null;
    }

    public function searchRecipesByNameAndIngredient($name, $ingredientName) {
        $ingredient = DB::table('ingredients')->select('id')->where('name', '=', $ingredientName)->first();
        if(!empty($ingredient)){
            $ingredient_id = $ingredient->id;
            $recipes_ids = DB::table('ingredients_lists')
                ->select('recipe_id')
                ->where('ingredient_id', '=', $ingredient_id)
                ->get();
            $ids = array();
            foreach ($recipes_ids as $id) {
                $ids[] = $id->recipe_id;
            }
            $recipes = Recipe::whereIn('id', $ids)
                ->where('name', 'LIKE', "%{$name}%")
                ->get();
            foreach ($recipes as $recipe){
                $ingredients = DB::table('ingredients_lists')
                    ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
                    ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
                    ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
                    ->where('ingredients_lists.recipe_id', '=', $recipe->id)
                    ->get();
                $recipe->ingredients = $ingredients;
            }
            return $recipes;
        }
        return null;
    }

    public function searchRecipesByNameIngredientCategory($name, $ingredientName, $category) {
        $ingredient = DB::table('ingredients')->select('id')->where('name', '=', $ingredientName)->first();
        if(!empty($ingredient)){
            $ingredient_id = $ingredient->id;
            $recipes_ids = DB::table('ingredients_lists')
                ->select('recipe_id')
                ->where('ingredient_id', '=', $ingredient_id)
                ->get();
            $ids = array();
            foreach ($recipes_ids as $id) {
                $ids[] = $id->recipe_id;
            }
            $recipes = Recipe::whereIn('id', $ids)
                ->where('name', 'LIKE', "%{$name}%")
                ->where('recipe_cat_id', '=', $category)
                ->get();
            foreach ($recipes as $recipe){
                $ingredients = DB::table('ingredients_lists')
                    ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
                    ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
                    ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
                    ->where('ingredients_lists.recipe_id', '=', $recipe->id)
                    ->get();
                $recipe->ingredients = $ingredients;
            }
            return $recipes;
        }
        return null;
    }

    public function getRecipeById($id) {
        $recipe = Recipe::find($id);
        $steps = DB::table('steps')
            ->where('recipe_id', '=', $id)->orderBy('step_num', 'ASC')
            ->get();
        $recipe->steps = $steps;
        $ingredients = DB::table('ingredients_lists')
            ->join('ingredients', 'ingredients_lists.ingredient_id', '=', 'ingredients.id')
            ->join('amounts', 'ingredients_lists.amount_id', '=', 'amounts.id')
            ->select('ingredients_lists.amount', 'ingredients_lists.amount_id', 'ingredients.id as productId', 'ingredients.name', 'ingredients.image', 'ingredients.kkal', 'amounts.name as amountName')
            ->where('ingredients_lists.recipe_id', '=', $id)
            ->get();
        $recipe->ingredients = $ingredients;
        return $recipe;
    }



}
