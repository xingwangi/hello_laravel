<?php

use Faker\Generator as Faker;


$factory->define(App\Models\User::class, function (Faker $faker) {
    $date_time = $faker->date . '' . $faker->time;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'activated' => true,
        'password' => bcrypt('admin888'), // secret
        'remember_token' => str_random(10),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
