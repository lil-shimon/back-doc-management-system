<?php

use Illuminate\Database\Seeder;

class PurchasedPostageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchased_postages')->truncate();

        DB::table('purchased_postages')->insert([
            [
                "document_id" => 1,
                "sender_place" => "埼玉県",
                "destination_place" => "東京都",
                "postage_price" => 13000,
                "number" => 1,
                "tax" => 0.1,
                "size" => "37インチ",
                "unit" => "個",
            ],
            [
                "document_id" => 1,
                "sender_place" => "埼玉県",
                "destination_place" => "福島県",
                "postage_price" => 17000,
                "number" => 2,
                "tax" => 0.1,
                "size" => "43インチ",
                "unit" => "個",
            ],
            [
                "document_id" => 1,
                "sender_place" => "埼玉県",
                "destination_place" => "名古屋",
                "postage_price" => 19000,
                "number" => 1,
                "tax" => 0.1,
                "size" => "37インチ",
                "unit" => "個",
            ],

            [
                "document_id" => 2,
                "sender_place" => "埼玉県",
                "destination_place" => "東京都",
                "postage_price" => 13000,
                "number" => 1,
                "tax" => 0.1,
                "size" => "37インチ",
                "unit" => "個",
            ],
            [
                "document_id" => 2,
                "sender_place" => "埼玉県",
                "destination_place" => "福島県",
                "postage_price" => 17000,
                "number" => 2,
                "tax" => 0.1,
                "size" => "43インチ",
                "unit" => "個",
            ],
            [
                "document_id" => 2,
                "sender_place" => "埼玉県",
                "destination_place" => "名古屋",
                "postage_price" => 19000,
                "number" => 1,
                "tax" => 0.1,
                "size" => "37インチ",
                "unit" => "個",
            ],

            [
                "document_id" => 3,
                "sender_place" => "埼玉県",
                "destination_place" => "東京都",
                "postage_price" => 13000,
                "number" => 1,
                "tax" => 0.1,
                "size" => "37インチ",
                "unit" => "個",
            ],
            [
                "document_id" => 3,
                "sender_place" => "埼玉県",
                "destination_place" => "福島県",
                "postage_price" => 17000,
                "number" => 2,
                "tax" => 0.1,
                "size" => "43インチ",
                "unit" => "個",
            ],
            [
                "document_id" => 3,
                "sender_place" => "埼玉県",
                "destination_place" => "名古屋",
                "postage_price" => 19000,
                "number" => 1,
                "tax" => 0.1,
                "size" => "37インチ",
                "unit" => "個",
            ],
        ]);
    }
}
