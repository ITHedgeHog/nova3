<?php

$factory->define(Nova\Foundation\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

$factory->define(Nova\Authorize\Role::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name
	];
});

$factory->define(Nova\Authorize\Permission::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'key' => 'key'
	];
});
