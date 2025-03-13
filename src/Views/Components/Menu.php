<?php

namespace GeoffroyRiou\NrCMS\Views\Components;

use Closure;
use GeoffroyRiou\NrCMS\Models\Menu as MenuModel;
use GeoffroyRiou\NrCMS\Services\MenuService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{

    private ?MenuModel $menu;

    /**
     * Create a new component instance.
     */
    public function __construct(private MenuService $menuService, int $menuId)
    {
        $this->menu = $this->menuService->getMenuFromId($menuId);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (!$this->menu) {
            return '';
        }
        
        return view('nrcms::components.menu.menu',[
            'items' => $this->menuService->hydrateMenu($this->menu->items)
        ]);
    }
}
