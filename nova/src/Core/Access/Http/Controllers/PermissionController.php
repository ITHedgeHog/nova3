<?php namespace Nova\Core\Access\Http\Controllers;

use Permission,
	BaseController,
	RoleRepositoryInterface,
	PermissionRepositoryInterface,
	EditPermissionRequest, CreatePermissionRequest, RemovePermissionRequest;
use Nova\Core\Access\Events;

class PermissionController extends BaseController {

	protected $repo;
	protected $roleRepo;

	public function __construct(PermissionRepositoryInterface $repo, RoleRepositoryInterface $roles)
	{
		parent::__construct();

		$this->repo = $repo;
		$this->roleRepo = $roles;

		$this->middleware('auth');
	}

	public function index()
	{
		$this->authorize('manage', new Permission, "You do not have permission to manage permissions.");

		$this->view = 'admin/access/permissions';
		$this->jsView = 'admin/access/permissions-js';
	}

	public function create()
	{
		$this->authorize('create', new Permission, "You do not have permission to create permissions.");

		$this->view = 'admin/access/permission-create';
		$this->jsView = 'admin/access/permission-create-js';
	}

	public function store(CreatePermissionRequest $request)
	{
		$this->authorize('create', new Permission, "You do not have permission to create permissions.");

		$permission = $this->repo->create($request->all());

		event(new Events\PermissionWasCreated($permission));

		flash()->success("Permission Created!", "Add your new permission to any of your roles now.");

		return redirect()->route('admin.access.permissions');
	}

	public function edit($permissionId)
	{
		$permission = $this->data->permission = $this->repo->find($permissionId);

		$this->authorize('edit', $permission, "You do not have permission to edit permissions.");

		$this->view = 'admin/access/permission-edit';
		$this->jsView = 'admin/access/permission-edit-js';
	}

	public function update(EditPermissionRequest $request, $permissionId)
	{
		$permission = $this->repo->find($permissionId);

		$this->authorize('edit', $permission, "You do not have permission to edit permissions.");

		$permission = $this->repo->update($permission, $request->all());

		event(new Events\PermissionWasUpdated($permission));

		flash()->success("Permission Updated!");

		return redirect()->route('admin.access.permissions');
	}

	public function remove($permissionId)
	{
		$this->isAjax = true;

		$permission = $this->repo->find($permissionId);

		if (policy($permission)->remove($this->user))
		{
			$body = ($permission)
				? view(locate('page', 'admin/access/permission-remove'), compact('permission'))
				: alert('danger', "permission not found.");
		}
		else
		{
			$body = alert('danger', "You do not have permission to remove permissions.");
		}

		return partial('modal-content', [
			'header' => "Remove Permission",
			'body' => $body,
			'footer' => false,
		]);
	}

	public function destroy(RemovePermissionRequest $request, $permissionId)
	{
		$this->authorize('remove', new Permission, "You do not have permission to remove permissions.");

		$permission = $this->repo->delete($permissionId);

		event(new Events\PermissionWasDeleted($permission->name, $permission->display_name));

		flash()->success("Permission Removed!");

		return redirect()->route('admin.access.permissions');
	}

	public function checkPermissionKey()
	{
		$this->isAjax = true;

		$count = $this->repo->countBy('name', request('key'));

		if ($count > 0)
		{
			return json_encode(['code' => 0]);
		}

		return json_encode(['code' => 1]);
	}

}
