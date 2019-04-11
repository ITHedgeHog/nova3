<?php

namespace Nova\Roles\Http\Controllers;

use Nova\Roles\Jobs;
use Nova\Roles\Events;
use Nova\Roles\Models\Role;
use Nova\Roles\Http\Requests;
use Nova\Roles\Http\Responses;
use Nova\Roles\Models\Ability;
use Nova\Roles\Http\Authorizers;
use Nova\Roles\Http\Resources\RoleResource;
use Nova\Roles\Http\Resources\RoleCollection;
use Nova\Foundation\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index(Authorizers\Index $auth)
    {
        return app(Responses\Index::class)
            ->withRoles(new RoleCollection(Role::orderBy('title')->get()));
    }

    public function create(Authorizers\Create $auth)
    {
        return app(Responses\Create::class)
            ->withAbilities(Ability::orderBy('title')->get());
    }

    public function store(Authorizers\Store $auth, Requests\Store $request)
    {
        $role = dispatch_now(new Jobs\CreateRole($request->validated()));

        event(new Events\RoleCreated($role));

        return $role->fresh();
    }

    public function edit(Authorizers\Edit $auth, Role $role)
    {
        return app(Responses\Edit::class)
            ->withRole(new RoleResource($role))
            ->withAbilities(Ability::orderBy('title')->get());
    }

    public function update(Authorizers\Update $auth, Requests\Update $request, Role $role)
    {
        $role = dispatch_now(new Jobs\UpdateRole($role, $request->validated()));

        event(new Events\RoleUpdated($role));

        return $role->fresh();
    }

    public function destroy(Authorizers\Destroy $auth, Role $role)
    {
        $role = dispatch_now(new Jobs\DeleteRole($role));

        event(new Events\RoleDeleted($role));

        return $role;
    }
}
