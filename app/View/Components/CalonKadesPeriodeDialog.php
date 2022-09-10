<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CalonKadesPeriodeDialog extends Component
{

    public $type;
    public $action;
    public $calonkades;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $action, $calonkades)
    {
        $this->type = $type;
        $this->action = $action;
        $this->calonkades = $calonkades;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.calon-kades-periode-dialog');
    }
}
