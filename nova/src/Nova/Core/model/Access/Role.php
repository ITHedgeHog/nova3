<?php namespace Nova\Core\Model\Access;

use Model;
use Cartalyst\Sentry\Groups\GroupInterface;

class Role extends Model implements GroupInterface {

	const INACTIVE		= 1;
	const USER			= 2;
	const ACTIVE		= 3;
	const POWERUSER		= 4;
	const ADMIN			= 5;
	const SYSADMIN		= 6;
	
	public $timestamps = false;

	protected $table = 'roles';

	protected $fillable = array(
		'name', 'desc', 'inherits',
	);
	
	protected static $properties = array(
		'id', 'name', 'desc', 'inherits',
	);

	/**
	 * Has Many: Users
	 */
	public function users()
	{
		return $this->hasMany('User');
	}

	/**
	 * Belongs To Many: Tasks
	 */
	public function tasks()
	{
		return $this->belongsToMany('AccessTask', 'roles_tasks');
	}
	
	/**
	 * Get all the tasks.
	 *
	 * @param	bool	Get inherited tasks as well?
	 * @return	Collection
	 */
	public function getTasks($getInherited = true)
	{
		// Loop through this role's tasks
		foreach ($this->tasks as $task)
		{
			$groups[] = $task;
		}

		// If there are inherited roles, loop through those too
		if ( ! empty($this->inherits) and $getInherited)
		{
			$groups += $this->getInheritedTasks(true);
		}

		return $this->newCollection($groups);
	}

	/**
	 * Get all inherited tasks.
	 *
	 * @param	bool	Return an array (false) or a Collection (true)
	 * @return	Collection
	 */
	public function getInheritedTasks($returnArray = false)
	{
		// Make a temporary group holder
		$groups = array();

		if ( ! empty($this->inherits))
		{
			// Make an array out of the inherited roles
			$inherited = explode(',', $this->inherits);

			// Loop through the inherited roles
			foreach ($inherited as $i)
			{
				// Start a new Query Builder
				$query = static::startQuery();

				// Put the tasks into the holding array
				$groups[] = $query->find($i)->getTasks();
			}
		}

		if ($returnArray)
		{
			return $groups;
		}

		return $this->newCollection($groups);
	}

	/*
	|--------------------------------------------------------------------------
	| Sentry Group Interface Methods
	|--------------------------------------------------------------------------
	|
	| Sentry provides an interface of methods that need to be implemented by
	| the model. In Nova's case, some of these aren't applicable, and in those
	| situations, we simply throw exceptions. In others, we do things the way
	| we've chosen to setup our authorization system.
	|
	*/

	/**
	 * Returns the group's ID.
	 *
	 * @return	int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Returns the group's name.
	 *
	 * @return	string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Returns permissions for the group included inherited permissions.
	 *
	 * @return	array
	 */
	public function getPermissions()
	{
		return $this->getTasks();
	}

}