<?php

use Illuminate\Database\Migrations\Migration;

class NovaCreateSystem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_info', function($t)
		{
			$t->increments('id');
			$t->string('uid', 32);
			$t->boolean('version_major')->default(3);
			$t->boolean('version_minor');
			$t->boolean('version_update');
			$t->string('ignore', 20)->nullable();
			$t->timestamps();
		});

		Schema::create('system_events', function($t)
		{
			$t->increments('id')->unsigned();
			$t->string('email', 100);
			$t->string('ip', 16);
			$t->integer('user_id')->nullable();
			$t->integer('character_id')->nullable();
			$t->text('content');
			$t->timestamps();
		});

		// Seed the database
		SystemModel::createItem(array(
			'uid'				=> Str::random(32),
			'version_major'		=> Config::get('app.version_major'),
			'version_minor'		=> Config::get('app.version_minor'),
			'version_update'	=> Config::get('app.version_update'),
		));

		SystemEvent::createItem(array(
			'content' => Config::get('app.name')." was successfully installed.",
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('system_info');
		Schema::drop('system_events');
	}
	
}