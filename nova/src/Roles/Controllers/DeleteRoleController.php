<?php

namespace Nova\Roles\Controllers;

use Nova\Roles\Models\Role;
use Illuminate\Http\Request;
use Nova\Roles\Actions\DeleteRole;
use Nova\Foundation\Controllers\Controller;
use Nova\Roles\Responses\DeleteRoleResponse;

class DeleteRoleController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function confirm(Request $request)
    {
        $role = Role::findOrFail($request->id);

        return app(DeleteRoleResponse::class)->with([
            'role' => $role,
        ]);
    }

    public function destroy(DeleteRole $action, Role $role)
    {
        $this->authorize('delete', $role);

        $action->execute($role);

        return redirect()
            ->route('roles.index')
            ->withToast("{$role->display_name} was deleted", 'All users who had been assigned this role have been updated.');
    }
}
