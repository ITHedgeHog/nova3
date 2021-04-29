<?php

namespace Nova\Posts\Livewire\Concerns;

trait WritesPost
{
    public $postId;

    public $title;

    public $day;

    public $time;

    public $location;

    public $content;

    public $post;

    public $ratingLanguage;

    public $ratingSex;

    public $ratingViolence;

    public function updatedContent($value)
    {
        // dd($value);
    }
}
