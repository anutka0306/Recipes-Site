<?php

namespace App\View\Components\Recipes;

use Illuminate\View\Component;

class Item extends Component
{
    /**
     * @var array
     */
    public $recipe;

    /**
     * Item constructor.
     * @param $recipe
     */
    public function __construct($recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.recipes.item');
    }
}
