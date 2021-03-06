<?php

namespace Tests\Unit\Stories\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Nova\Stories\Actions\SetStoryPosition;
use Nova\Stories\DataTransferObjects\StoryPositionData;
use Nova\Stories\Models\Story;
use Tests\TestCase;

/**
 * @group stories
 */
class SetStoryPositionActionTest extends TestCase
{
    use RefreshDatabase;

    protected $action;

    protected $story;

    protected $mainTimeline;

    public function setUp(): void
    {
        parent::setUp();

        $this->action = app(SetStoryPosition::class);

        $this->mainTimeline = Story::whereMainTimeline()->first();

        $this->story = Story::factory()->create();

        $this->mainTimeline->appendNode($this->story);

        $this->mainTimeline->refresh();
        $this->story->refresh();
    }

    /** @test **/
    public function itCreatesAStoryBeforeAnotherStory()
    {
        $firstStory = Story::factory()->create([
            'title' => 'First Story',
        ]);
        $this->mainTimeline->appendNode($firstStory);
        $firstStory->refresh();

        $data = new StoryPositionData([
            'direction' => 'before',
            'neighbor' => $firstStory,
            'hasPositionChange' => true,
        ]);

        $this->action->execute($this->story, $data);

        $this->story->refresh();
        $firstStory->refresh();

        $this->assertEquals(2, $this->story->_lft);
        $this->assertEquals(4, $firstStory->_lft);
    }

    /** @test **/
    public function itCreatesAStoryAfterAnotherStory()
    {
        $mainTimeline = Story::whereMainTimeline()->first();

        $firstStory = Story::factory()->create([
            'title' => 'First Story',
        ]);
        $firstStory->appendToNode($mainTimeline)->save();

        $data = new StoryPositionData([
            'direction' => 'after',
            'neighbor' => $firstStory,
            'hasPositionChange' => true,
        ]);

        $this->action->execute($this->story, $data);

        $this->story->refresh();
        $firstStory->refresh();

        $this->assertEquals(2, $firstStory->_lft);
        $this->assertEquals(4, $this->story->_lft);
    }

    /** @test **/
    public function itCreatesANestedStoryBeforeAnotherStory()
    {
        $mainTimeline = Story::whereMainTimeline()->first();

        $firstStory = Story::factory()->create([
            'title' => 'First Story',
        ]);
        $firstStory->appendToNode($mainTimeline)->save();
        $firstStory->refresh();

        $secondStory = Story::factory()->create([
            'title' => 'Second Story',
        ]);
        $secondStory->appendToNode($firstStory)->save();

        $data = new StoryPositionData([
            'parent_id' => $firstStory->id,
            'direction' => 'before',
            'neighbor' => $secondStory,
            'hasPositionChange' => true,
        ]);

        $this->action->execute($this->story, $data);

        $this->story->refresh();
        $firstStory->refresh();
        $secondStory->refresh();

        $this->assertEquals($firstStory->id, $this->story->parent_id);
        $this->assertEquals(3, $this->story->_lft);
        $this->assertEquals(5, $secondStory->_lft);
    }

    /** @test **/
    public function itCreatesANestedStoryAfterAnotherStory()
    {
        $mainTimeline = Story::whereMainTimeline()->first();

        $firstStory = Story::factory()->create([
            'title' => 'First Story',
        ]);
        $firstStory->appendToNode($mainTimeline)->save();
        $firstStory->refresh();

        $secondStory = Story::factory()->create([
            'title' => 'Second Story',
        ]);
        $secondStory->appendToNode($firstStory)->save();

        $data = new StoryPositionData([
            'parent_id' => $firstStory->id,
            'direction' => 'after',
            'neighbor' => $secondStory,
            'hasPositionChange' => true,
        ]);

        $this->action->execute($this->story, $data);

        $this->story->refresh();
        $firstStory->refresh();
        $secondStory->refresh();

        $this->assertEquals($firstStory->id, $this->story->parent_id);
        $this->assertEquals(5, $this->story->_lft);
        $this->assertEquals(3, $secondStory->_lft);
    }
}
