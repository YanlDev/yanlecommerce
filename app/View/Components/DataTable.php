<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DataTable extends Component
{
    /**
     * Create a new component instance.
     */
    public $rows;
    public $columnsTable;
    public $fields;
    public $routeEdit;

    public function __construct($rows,$columnsTable,$fields,$routeEdit = null)
    {
        $this->rows = $rows;
        $this->columnsTable = $columnsTable;
        $this->fields = $fields;
        $this->routeEdit = $routeEdit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-table');
    }
}
