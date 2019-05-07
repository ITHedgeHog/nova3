<?php

namespace Nova\Users\Http\Authorizers;

use Nova\Foundation\Http\Requests\AuthorizesRequest;

class Update extends AuthorizesRequest
{
    public function authorize()
    {
        return $this->user()->can('user.update');
    }
}
