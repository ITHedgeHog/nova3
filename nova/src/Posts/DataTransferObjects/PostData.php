<?php

namespace Nova\Posts\DataTransferObjects;

use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;

class PostData extends DataTransferObject
{
    public ?int $id;

    public ?string $content;

    public int $post_type_id;

    public int $story_id;

    public ?string $title;

    public ?string $day;

    public ?string $time;

    public ?string $location;

    public int $word_count = 0;

    public int $rating_language = 1;

    public int $rating_sex = 1;

    public int $rating_violence = 1;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int) data_get($array, 'id'),
            'content' => data_get($array, 'content'),
            'day' => data_get($array, 'day'),
            'location' => data_get($array, 'location'),
            'post_type_id' => (int) data_get($array, 'postTypeId'),
            'story_id' => (int) data_get($array, 'storyId'),
            'time' => data_get($array, 'time'),
            'title' => data_get($array, 'title'),
            'word_count' => Str::of(data_get($array, 'content', ''))->pipe('strip_tags')->wordCount(),
            'rating_language' => (int) data_get($array, 'ratingLanguage', 1),
            'rating_sex' => (int) data_get($array, 'ratingSex', 1),
            'rating_violence' => (int) data_get($array, 'ratingViolence', 1),
        ]);
    }
}
