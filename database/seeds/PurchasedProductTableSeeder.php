<?php

use Illuminate\Database\Seeder;

class PurchasedProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchased_products')->truncate();

        DB::table('purchased_products')->insert([
            [
                "document_id" => 1,
                "name" => "product1",
                "number" => 5,
                "unit" => "個",
                "unit_price" => 1000,
                "tax" => 0.1,
            ],
            [
                "document_id" => 1,
                "name" => "product2",
                "number" => 2,
                "unit" => "個",
                "unit_price" => 100,
                "tax" => 0.1,
            ],
            [
                "document_id" => 1,
                "name" => "product3",
                "number" => 1,
                "unit" => "個",
                "unit_price" => 10000,
                "tax" => 0.1,
            ],

            [
                "document_id" => 2,
                "name" => "product1",
                "number" => 5,
                "unit" => "個",
                "unit_price" => 1000,
                "tax" => 0.1,
            ],
            [
                "document_id" => 2,
                "name" => "product2",
                "number" => 2,
                "unit" => "個",
                "unit_price" => 100,
                "tax" => 0.1,
            ],
            [
                "document_id" => 2,
                "name" => "product3",
                "number" => 1,
                "unit" => "個",
                "unit_price" => 10000,
                "tax" => 0.1,
            ],

            [
                "document_id" => 3,
                "name" => "product1",
                "number" => 5,
                "unit" => "個",
                "unit_price" => 1000,
                "tax" => 0.1,
            ],
            [
                "document_id" => 3,
                "name" => "product2",
                "number" => 2,
                "unit" => "個",
                "unit_price" => 100,
                "tax" => 0.1,
            ],
            [
                "document_id" => 3,
                "name" => "product3",
                "number" => 1,
                "unit" => "個",
                "unit_price" => 10000,
                "tax" => 0.1,
            ],
        ]);
    }
}
