<?php

namespace Nova\Themes\Http\Authorizors;

use Nova\Foundation\Http\Requests\AuthorizesRequest;

class Store extends AuthorizesRequest
{
    public function authorize()
    {
        return $this->user()->can('theme.create');
    }
}
