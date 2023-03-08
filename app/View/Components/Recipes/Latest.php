<?php

namespace App\View\Components\Recipes;

use Illuminate\View\Component;

class Latest extends Component
{
    /**
     * @var array
     */
    public $recipes;

    /**
     * Latest constructor.
     * @param $recipes
     */
    public function __construct($recipes)
    {
        $this->recipes = $recipes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.recipes.latest');
    }
}
