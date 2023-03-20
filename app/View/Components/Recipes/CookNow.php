<?php

namespace App\View\Components\Recipes;

use Illuminate\View\Component;

class CookNow extends Component
{
    /**
     * @var array
     */
   public $cookNowRecipe;

    /**
     * CookNow constructor.
     * @param $cookNowRecipe
     */
    public function __construct($cookNowRecipe)
    {
        $this->cookNowRecipe = $cookNowRecipe;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.recipes.cook-now');
    }
}
