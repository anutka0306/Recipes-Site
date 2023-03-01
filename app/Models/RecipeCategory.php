<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category;

class RecipeCategory extends Model
{
    use HasFactory;

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'recipe_cat_id', 'id');
    }
    public function getAllCategories() {
        return RecipeCategory::all();
    }
    public function getCategoryById($id) {
        return RecipeCategory::where('id', $id)->limit(1)->get();
    }

}
