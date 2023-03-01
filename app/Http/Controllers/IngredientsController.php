<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientsController extends Controller
{
    public function findIngredient(Request $request, Ingredient $ingredient)
    {
        if(!empty(trim($request->q)))
        {
            $result = $ingredient->getIngredients($request->q);
            echo $result;
        }
        return false;
    }
}
