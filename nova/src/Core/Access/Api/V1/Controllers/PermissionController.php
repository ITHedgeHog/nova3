<?php namespace Nova\Core\Access\Api\V1\Controllers;

use PermissionRepositoryInterface;
use Nova\Foundation\Api\V1\Controllers\ApiBaseController;
use Nova\Core\Access\Api\V1\Transformers\PermissionTransformer;

class PermissionController extends ApiBaseController {

	protected $repo;

	public function __construct(PermissionRepositoryInterface $repo)
	{
		$this->repo = $repo;
	}

	public function index()
	{
		return $this->response->collection($this->repo->all(), new PermissionTransformer);
	}

	public function show($permissionId)
	{
		$permission = $this->repo->getById($permissionId);

		if ( ! $permission)
		{
			return $this->response->errorNotFound('Permission not found');
		}

		return $this->response->item($permission, new PermissionTransformer);
	}

}
