<?php

namespace Nova\Stories\Models\States;

use Nova\Stories\Models\Story;
use Spatie\ModelStates\Transition;

class UpcomingToCompleted extends Transition
{
    protected $story;

    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    public function handle(): Story
    {
        $this->story->status = Completed::class;
        $this->story->start_date = now();
        $this->story->end_date = now();
        $this->story->save();

        return $this->story->refresh();
    }
}
