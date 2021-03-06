<?php

namespace Nova\Foundation\View\Components;

use Illuminate\View\Component;

class AvatarGroup extends Component
{
    public $size;

    public $items;

    public $limit;

    public function __construct($size = 'md', $items = null, $limit = 4)
    {
        $this->size = $size;
        $this->items = $items;
        $this->limit = $limit;
    }

    public function styles()
    {
        return 'ring-2 ring-white';
    }

    public function render()
    {
        return view('components.avatar-group');
    }
}
