<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'role' => $faker->randomElement(['Super Admin', 'Admin HRD','Kepala Unit','Staff'])
    ];
});
