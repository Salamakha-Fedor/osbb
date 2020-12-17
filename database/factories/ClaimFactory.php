<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Claim::class, function (Faker $faker) {
    return [
        'title' => $faker->text(150),
        'text' => $faker->text(3000),
        'client_id' => function () {
            $client = factory(App\Client::class)->create();
            return $client->id;
        },
        'in_work' => $faker->boolean,
        'created_at' => now()
    ];
});
