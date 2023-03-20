<?php

namespace App\View\Components\Sliders;

use Illuminate\View\Component;

class Flex extends Component
{
    /**
     * @var array
     */
    public $bannerRecipes;

    /**
     * Flex constructor.
     * @param $bannerRecipes
     */
    public function __construct($bannerRecipes)
    {
        $this->bannerRecipes = $bannerRecipes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sliders.flex');
    }
}
