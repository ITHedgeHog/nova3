<?php namespace Nova\Core\Users\Data\Presenters;

use BasePresenter;

class UserPresenter extends BasePresenter {

	public function firstName()
	{
		if ($this->entity->nickname)
		{
			return $this->entity->nickname;
		}

		return explode(' ', $this->entity->name)[0];
	}

	public function name()
	{
		if ($this->entity->nickname)
		{
			return $this->entity->nickname;
		}

		return $this->entity->name;
	}

	public function realName()
	{
		return $this->entity->name;
	}

}
