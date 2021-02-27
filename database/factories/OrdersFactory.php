<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Orders;
use Faker\Generator as Faker;

$factory->define(Orders::class, function (Faker $faker) {
    return [
      'start_date' => 'Oct 2',
      'end_date' => 'Oct 2',
      'expected_start_date' => 'Oct 2',
      'expected_end_date' => 'Oct 2'
    ];
});
