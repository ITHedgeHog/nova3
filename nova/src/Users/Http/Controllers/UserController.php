<?php

namespace Nova\Users\Http\Controllers;

use Nova\Users\Models\User;
use Nova\Users\Jobs;
use Nova\Users\Events;
use Nova\Roles\Models\Role;
use Nova\Users\Http\Responses;
use Nova\Users\Http\Resources;
use Nova\Users\Http\Validators;
use Nova\Users\Http\Authorizors;
use Nova\Foundation\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function index(Authorizors\Index $gate)
    {
        $users = User::get();

        return app(Responses\Index::class)
            ->withUsers(new Resources\UserCollection($users))
            ->withPendingUsers($users->pending());
    }

    public function create(Authorizors\Create $gate)
    {
        return app(Responses\Create::class)
            ->withRoles(Role::orderBy('title')->get());
    }

    public function store(Authorizors\Store $gate, Validators\Store $request)
    {
        $user = dispatch_now(new Jobs\Create($request->validated()));

        event(new Events\AdminCreated($user));

        return $user->fresh();
    }

    public function edit(Authorizors\Edit $gate, User $user)
    {
        return app(Responses\Edit::class)
            ->withRoles(Role::orderBy('title')->get())
            ->withUser(new Resources\UserResource($user));
    }

    public function update(Authorizors\Update $gate, Validators\Update $request, User $user)
    {
        $user = dispatch_now(new Jobs\Update($user, $request->validated()));

        event(new Events\AdminUpdated($user->fresh()));

        return $user->fresh();
    }

    public function destroy(Authorizors\Destroy $gate, User $user)
    {
        $user = dispatch_now(new Jobs\Delete($user));

        event(new Events\AdminDeleted($user));

        return $user;
    }
}
