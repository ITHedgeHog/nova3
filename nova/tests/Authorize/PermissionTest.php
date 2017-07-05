<?php namespace Tests\Authorize;

use Nova\Authorize\Permission;
use Tests\DatabaseTestCase;

class PermissionTest extends DatabaseTestCase
{
	protected $permission;

	public function setUp()
	{
		parent::setUp();

		$this->permission = create('Nova\Authorize\Permission');
	}

	/** @test **/
	public function it_belongs_to_roles()
	{
		$this->assertInstanceOf(
			'Illuminate\Database\Eloquent\Collection',
			$this->permission->roles
		);

		$role = create('Nova\Authorize\Role');

		$this->permission->roles()->attach($role->id);

		$this->assertCount(1, $this->permission->fresh()->roles);
	}
}
