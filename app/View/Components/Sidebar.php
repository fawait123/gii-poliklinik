<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Menu items configuration
     *
     * @var array
     */
    public array $menuItems = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menuItems = $this->getMenuItems();
    }

    /**
     * Get menu items configuration from config file
     *
     * @return array
     */
    protected function getMenuItems(): array
    {
        return config('menu', []);
    }

    /**
     * Check if any submenu item is active
     *
     * @param array $submenu
     * @return bool
     */
    public function isSubmenuActive(array $submenu): bool
    {
        foreach ($submenu as $item) {
            if (request()->routeIs($item['activeRoute'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
