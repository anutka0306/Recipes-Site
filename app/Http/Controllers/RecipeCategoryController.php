<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecipeCategory;

class RecipeCategoryController extends Controller
{
    public RecipeCategory $recipeCategory;

    public function __construct(RecipeCategory $recipeCategory) {
        $this->recipeCategory = $recipeCategory;
    }

    public function getAllCategories() {
        return $this->recipeCategory->getAllCategories();
    }

    public function getCategoryById($id) {
        return $this->recipeCategory->getCategoryById($id);
    }
}
