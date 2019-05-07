<?php

namespace Nova\Themes\Http\Authorizors;

use Nova\Foundation\Http\Requests\AuthorizesRequest;

class Install extends AuthorizesRequest
{
    public function authorize()
    {
        return $this->user()->can('theme.create');
    }
}
