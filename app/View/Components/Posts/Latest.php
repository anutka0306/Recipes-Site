<?php

namespace App\View\Components\Posts;

use Illuminate\View\Component;

class Latest extends Component
{
   public $posts;

    /**
     * Latest constructor.
     * @param $posts
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.posts.latest');
    }
}
