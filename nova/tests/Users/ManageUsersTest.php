<?php namespace Tests\Users;

use Date;
use Mail;
use Nova\Users\User;
use Tests\DatabaseTestCase;
use Nova\Users\Mail\SendNewPassword;

class ManageUsersTests extends DatabaseTestCase
{
	protected $user;

	public function setUp()
	{
		parent::setUp();

		$this->user = create('Nova\Users\User');
	}

	/** @test **/
	public function unauthorized_users_cannot_manage_users()
	{
		$this->withExceptionHandling();

		$this->get(route('users.index'))->assertRedirect(route('login'));
		$this->get(route('users.create'))->assertRedirect(route('login'));
		$this->post(route('users.store'))->assertRedirect(route('login'));
		$this->get(route('users.edit', $this->user))->assertRedirect(route('login'));
		$this->patch(route('users.update', $this->user))->assertRedirect(route('login'));
		$this->delete(route('users.destroy', $this->user))->assertRedirect(route('login'));

		// $this->signIn();

		// $this->get(route('roles.index'))->assertStatus(403);
		// $this->get(route('roles.create'))->assertStatus(403);
		// $this->post(route('roles.store'))->assertStatus(403);
		// $this->get(route('roles.edit', $this->role))->assertStatus(403);
		// $this->patch(route('roles.update', $this->role))->assertStatus(403);
		// $this->patch(route('roles.restore', $this->role))->assertStatus(403);
		// $this->delete(route('roles.destroy', $this->role))->assertStatus(403);
	}

	/** @test **/
	public function a_user_can_be_created()
	{
		$this->signIn();

		create('Nova\Authorize\Role', [], 3);

		$user = make('Nova\Users\User', ['roles' => [1,3]]);

		$this->post(route('users.store'), $user->toArray());

		$this->assertDatabaseHas('users', ['name' => $user->name, 'email' => $user->email]);
		$this->assertDatabaseHas('users_roles', ['user_id' => 3, 'role_id' => 1]);
		$this->assertDatabaseHas('users_roles', ['user_id' => 3, 'role_id' => 3]);

		// TODO: Make sure preferences are created properly
	}

	/** @test **/
	public function an_email_is_sent_with_the_password_when_a_user_is_created()
	{
		Mail::fake();

		$this->signIn();

		$user = make('Nova\Users\User', ['roles' => [1,3]]);

		$this->post(route('users.store'), $user->toArray());

		$createdUser = User::latest()->first();

		Mail::assertSent(SendNewPassword::class, function ($mail) use ($createdUser) {
			return $mail->hasTo($createdUser->email);
		});
	}

	/** @test **/
	public function a_user_can_be_updated()
	{
		$this->signIn();

		$this->patch(
			route('users.update',
			[$this->user]),
			['name' => 'Jack Sparrow', 'email' => 'pirates_life_4_me@gmail.com']
		);

		$this->assertDatabaseHas('users', [
			'name' => 'Jack Sparrow',
			'email' => 'pirates_life_4_me@gmail.com'
		]);
	}

	/** @test **/
	public function a_user_can_be_deleted()
	{
		$this->signIn();

		$user = create('Nova\Users\User');

		$this->delete(route('users.destroy', [$user]));

		$this->assertSoftDeleted('users', ['id' => $user->id]);

		// TODO: Make sure any characters are also soft deleted
	}

	/** @test **/
	public function a_user_can_be_restored()
	{
		$this->signIn();

		$user = create('Nova\Users\User', ['deleted_at' => Date::now()]);

		$this->patch(route('users.restore', [$user]));

		$this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
	}

	/** @test **/
	public function a_user_can_be_force_deleted()
	{
		# code...
	}
}