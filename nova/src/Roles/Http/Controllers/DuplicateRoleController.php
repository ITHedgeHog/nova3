<?php

namespace Nova\Roles\Http\Controllers;

use Nova\Roles\Jobs;
use Nova\Roles\Events;
use Nova\Roles\Models\Role;
use Nova\Foundation\Http\Controllers\Controller;
use Nova\Roles\Http\Requests\Duplicate as ValidateDuplicatingRole;
use Nova\Roles\Http\Authorizers\Duplicate as AuthorizeDuplicatingRole;

class DuplicateRoleController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function __invoke(AuthorizeDuplicatingRole $gate, ValidateDuplicatingRole $request, Role $originalRole)
    {
        $role = dispatch_now(new Jobs\DuplicateRole($originalRole));

        event(new Events\RoleDuplicated($role, $originalRole));

        return $role->fresh();
    }
}
