<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toggle extends Component
{
    public $id; // ID toggle
    public $isActive; // Status awal toggle (true/false)
    public $deviceId;

    public function __construct($id = null, $isActive = false, $deviceId = null)
    {
        $this->id = $id;
        $this->isActive = $isActive;
        $this->deviceId = $deviceId;
    }

    public function render()
    {
        return view('components.toggle');
    }
}
