<?php

namespace Nova\Posts\Livewire;

use Livewire\Component;

class PickPostType extends Component
{
    public $postTypes;

    public function render()
    {
        return view('livewire.posts.pick-post-type');
    }
}
