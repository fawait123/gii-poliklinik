<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuIcon extends Component
{
    public string $name;
    public string $class;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $class = '')
    {
        $this->name = $name;
        $this->class = $class;
    }

    /**
     * Get the SVG content from file
     */
    public function getSvgContent(): string
    {
        $svgPath = public_path("assets/svg/{$this->name}.svg");

        if (!file_exists($svgPath)) {
            return '';
        }

        $svgContent = file_get_contents($svgPath);

        // Remove the opening <svg> tag and closing </svg> tag to get only the inner content
        $svgContent = preg_replace('/<svg[^>]*>/', '', $svgContent);
        $svgContent = str_replace('</svg>', '', $svgContent);

        // Remove hardcoded stroke and fill colors to use currentColor from CSS
        $svgContent = preg_replace('/stroke="[^"]*"/', '', $svgContent);
        $svgContent = preg_replace('/fill="(?!none)[^"]*"/', '', $svgContent);

        return trim($svgContent);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-icon');
    }
}
