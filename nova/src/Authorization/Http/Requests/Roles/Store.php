<?php

namespace Nova\Authorization\Http\Requests\Roles;

use Nova\Foundation\Http\Requests\BaseFormRequest;

class Store extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'title' => 'required',
        ];
    }
}
