<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datepicker extends Component
{
    public $dateFormat = "YYYY-MM-DD";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datepicker');
    }
}
