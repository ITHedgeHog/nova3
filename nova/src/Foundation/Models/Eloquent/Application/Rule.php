<?php namespace Nova\Core\Models\Eloquent\Application;

use Model;

class Rule extends Model {
	
	public $timestamps = false;

	protected $table = 'application_rules';

	protected $fillable = array(
		'type', 'condition', 'users',
	);
	
	protected static $properties = array(
		'id', 'type', 'condition', 'users',
	);

}