<?php namespace Nova\Core\Access\Policies;

use Nova\Foundation\Policies\Policy;

class RolePolicy extends Policy
{
	protected $createKey = 'access.create';
	protected $editKey = 'access.edit';
	protected $removeKey = 'access.remove';
}
