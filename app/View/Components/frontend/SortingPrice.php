<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class SortingPrice extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $prices;
    public function __construct($prices)
    {
        $this->prices = $prices;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.sorting-price');
    }
}
