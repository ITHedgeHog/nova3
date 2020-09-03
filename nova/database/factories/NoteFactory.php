<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Nova\Notes\Models\Note;
use Nova\Users\Models\User;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'user_id' => fn () => factory(User::class)->create()->id,
        'title' => $faker->words(mt_rand(3, 10), true),
        'content' => $faker->paragraphs(mt_rand(1, 5), true),
        'summary' => $faker->sentences(mt_rand(1, 5), true),
    ];
});
