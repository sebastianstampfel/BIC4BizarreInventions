<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invention;
use Faker\Generator as Faker;

$factory->define(Invention::class, function (Faker $faker) {
    return [
        'name' => $slug = $faker->company,
        'description' => $faker->paragraph,
        'domain_id' => function () {
            return App\Domain::inRandomOrder()->first();
        },
    ];
});
