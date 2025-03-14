<?php

namespace GeoffroyRiou\NrCms\Views\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class PageBuilder extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(private Model $model) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('nrcms::components.page-builder.page-builder', [
            'blocks' => $this->model->page_blocks ?? []
        ]);
    }
}
