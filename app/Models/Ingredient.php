<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public function ingredients_list()
    {
        $this->hasMany(IngredientsList::class, 'ingredient_id', 'id');
    }

    public function getIngredients($q)
    {
       $ingredients = Ingredient::where('name', 'LIKE', "%{$q}%")->get();
       return $ingredients;
    }

}
