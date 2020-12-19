<?php

use App\Models\JournalType;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(JournalType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
