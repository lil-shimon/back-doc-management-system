<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'order_date' => $faker->creditCardExpirationDateString,
        'note' => $faker->word,
        'sub_total' => $faker->numberBetween(10000, 999999),
        'quotation' => $faker->word,
        'invoice' => $faker->word,
        'total_price' => $faker->numberBetween(10001, 9999999),
        'remarks' => $faker->word,
        'order_id' => $faker->numberBetween(1, 10),
        'additional_invoice_id' => 1,
    ];
});
