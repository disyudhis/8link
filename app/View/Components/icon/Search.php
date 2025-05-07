<?php

namespace App\View\Components\icon;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public $size;
    public $class;

    public function __construct($size = 5, $class = '')
    {
        $this->size = $size;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.icon.search');
    }
}