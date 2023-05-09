<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MetaDescription extends Component
{
    public $metaDescription;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('meta.description');
    }
}
