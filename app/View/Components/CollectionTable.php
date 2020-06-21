<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CollectionTable extends Component
{

    public $data;

    public $columns;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data, $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $columns = $this->columns;
        $data = $this->data;
        return view('components.collection-table', compact('columns','data'));
    }
}
