<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'start_date' => $faker->creditCardExpirationDateString,
        'end_date' => $faker->creditCardExpirationDateString,
        'expected_start_date' => $faker->creditCardExpirationDateString,
        'expected_end_date' => $faker->creditCardExpirationDateString,
        'invoice_note' => $faker->word,
        'sale_note' => $faker->word,
        'maintainance_note' => $faker->word,
        'sim_number' => $faker->creditCardNumber,
        'signnage_id' => $faker->bankAccountNumber,
        'condition_id' => 1,
        'user_id' => 1,
        'company_name' => $faker->word,
        'site_name' => $faker->word,
        'additional_invoice_id' => $faker->numberBetween(1, 2),
        'phone_number' => $faker->word,
        'site_representative' => $faker->word,
        'site_representative_phone' => $faker->numberBetween(100000000, 999999999),
        'site_mail' => $faker->word,
        'site_address' => $faker->word,
        'total_price' => $faker->numberBetween(1000000000, 99999999999)
    ];
});
