<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toggle extends Component
{
    public $id; // ID toggle
    public $isActive; // Status awal toggle (true/false)

    public function __construct($id = null, $isActive = false)
    {
        $this->id = $id;
        $this->isActive = $isActive;
    }

    public function render()
    {
        return view('components.toggle');
    }
}
