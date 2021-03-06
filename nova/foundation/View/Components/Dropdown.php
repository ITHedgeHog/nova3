<?php

namespace Nova\Foundation\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $placement;

    public $triggerColor;

    public $triggerSize;

    public $wide;

    public string $id;

    public function __construct(
        $placement = 'bottom-start',
        $wide = false,
        $triggerColor = 'gray-text',
        $triggerSize = 'none',
        $id = 'options-menu'
    ) {
        $this->triggerColor = $triggerColor;
        $this->placement = $placement;
        $this->triggerSize = $triggerSize;
        $this->wide = $wide;
        $this->id = $id;
    }

    public function divider()
    {
        return 'border-t border-gray-100 my-1';
    }

    public function icon()
    {
        return 'mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500 group-focus:text-gray-500';
    }

    public function link()
    {
        return 'group flex items-center w-full px-4 py-2 text-sm font-medium text-gray-700 transition ease-in-out duration-150 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900';
    }

    public function text()
    {
        return 'block px-4 py-3 text-sm';
    }

    public function placementStyles()
    {
        switch ($this->placement) {
            case 'bottom-center':
                return 'left-0 origin-top';

            break;

            case 'bottom-end':
                return 'right-0 origin-top-right';

            break;

            case 'bottom-start':
                return 'left-0 origin-top-left';

            break;

            case 'top-center':
                return 'left-0 origin-bottom';

            break;

            case 'top-end':
                return 'right-0 origin-bottom-right';

            break;

            case 'top-start':
                return 'left-0 origin-bottom-left';

            break;
        }
    }

    public function render()
    {
        return view('components.dropdown');
    }
}
