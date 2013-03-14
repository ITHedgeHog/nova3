<?php

use Illuminate\Database\Migrations\Migration;

class NovaCreateCatalogs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('catalog_modules', function($t)
		{
			$t->increments('id');
			$t->string('name');
			$t->string('short_name', 50)->nullable();
			$t->string('location');
			$t->text('desc')->nullable();
			$t->boolean('protected')->default((int) false);
			$t->boolean('status')->default(Status::ACTIVE);
			$t->text('credits')->nullable();
			$t->timestamps();
		});

		Schema::create('catalog_ranks', function($t)
		{
			$t->increments('id');
			$t->string('name');
			$t->string('location');
			$t->string('preview', 50)->default('preview.png');
			$t->string('blank', 50)->default('blank.png');
			$t->string('extension', 5)->default('.png');
			$t->boolean('status')->default(Status::ACTIVE);
			$t->text('credits')->nullable();
			$t->boolean('default')->default((int) false);
			$t->string('genre', 10);
			$t->timestamps();
		});

		Schema::create('catalog_skins', function($t)
		{
			$t->increments('id');
			$t->string('name');
			$t->string('location');
			$t->text('credits')->nullable();
			$t->string('version', 10)->nullable();
			$t->timestamps();
		});

		Schema::create('catalog_skin_sections', function($t)
		{
			$t->increments('id');
			$t->string('section', 50);
			$t->string('skin', 100);
			$t->string('preview', 50)->nullable();
			$t->boolean('status')->default(Status::ACTIVE);
			$t->boolean('default')->default((int) false);
			$t->string('nav', 20)->default('dropdown');
			$t->timestamps();
		});

		Schema::create('catalog_widgets', function($t)
		{
			$t->increments('id');
			$t->string('name');
			$t->string('location');
			$t->string('page', 100);
			$t->boolean('zone')->nullable();
			$t->boolean('status')->default(Status::ACTIVE);
			$t->text('credits')->nullable();
			$t->timestamps();
		});

		// Seed the database
		$this->seed();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('catalog_modules');
		Schema::drop('catalog_ranks');
		Schema::drop('catalog_skins');
		Schema::drop('catalog_skin_sections');
		Schema::drop('catalog_widgets');
	}

	protected function seed()
	{
		$this->seedRanks();
		$this->seedSkins();
	}

	protected function seedRanks()
	{
		// Get the genre
		$genre = Config::get('nova.genre');

		// Pull in the genre data file
		include SRCPATH."Setup/assets/install/genres/{$genre}.php";

		foreach ($catalog_ranks as $c)
		{
			RankCatalogModel::createItem($c);
		}
	}

	protected function seedSkins()
	{
		$skins = array(
			array(
				'name' => 'Default',
				'location' => 'default',
				'credits' => '',
				'version' => ''
			),
		);

		foreach ($skins as $s)
		{
			SkinCatalogModel::createItem($s);
		}

		$skinSections = array(
			array(
				'section' => 'main',
				'skin' => 'default',
				'preview' => 'preview-main.jpg',
				'default' => (int) true),
			array(
				'section' => 'login',
				'skin' => 'default',
				'preview' => 'preview-login.jpg',
				'default' => (int) true),
			array(
				'section' => 'admin',
				'skin' => 'default',
				'preview' => 'preview-admin.jpg',
				'default' => (int) true),
		);

		foreach ($skinSections as $c)
		{
			SkinSectionCatalogModel::createItem($c);
		}
	}

}