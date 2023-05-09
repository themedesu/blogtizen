<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MetaTitle extends Component
{
    public $metaTitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('meta.title');
    }
}
