<?php

namespace Nova\Posts\Requests;

use Nova\Foundation\Requests\ValidatesRequest;

class CreatePostRequest extends ValidatesRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required'],
            'post_type_id' => ['required', 'exists:post_types,id'],
            'story_id' => ['required', 'exists:stories,id'],
            'title' => ['required'],
        ];
    }
}
