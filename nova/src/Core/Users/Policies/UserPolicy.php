<?php namespace Nova\Core\Users\Policies;

use User;

class UserPolicy {

	public function create(User $user)
	{
		return $user->can('user.create');
	}

	public function edit(User $user)
	{
		return $user->can('user.edit');
	}

	public function manage(User $user)
	{
		return ($this->create($user) or $this->edit($user) or $this->remove($user));
	}

	public function remove(User $user)
	{
		return $user->can('user.remove');
	}

}