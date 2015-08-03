<?php namespace Nova\Core\Access\Events;

use Nova\Foundation\Events\Event;
use Illuminate\Queue\SerializesModels;

class RoleWasDeleted extends Event {

	use SerializesModels;

	protected $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

}
