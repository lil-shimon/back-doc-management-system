<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attachment;
use Faker\Generator as Faker;

$factory->define(Attachment::class, function (Faker $faker) {
    return [
      'file_path' => $faker->word,
      'order_id' => $faker->numberBetween(1, 10),
    ];
});
