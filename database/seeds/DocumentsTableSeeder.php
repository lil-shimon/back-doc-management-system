<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->truncate();

        DB::table('documents')->insert([
            [
                "sell_part_id" => 1,
                "see_part_id" => 1,
                "customer_part_id" => 1,
                "document_type_id" => 1,
                "user_id" => 1,
                "document_title" => "title1",
                "logo_img_path" => "questar.jpg",
                "status" => 0,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "business_partner_company_name" => "company1",
                "honorific_title" => "御中",
                "payment_terms" => "sample",
                "usage_period" => "sample",
                "term_and_conditions" => "sample"
            ],
            [
                "sell_part_id" => 2,
                "see_part_id" => 2,
                "customer_part_id" => 2,
                "document_type_id" => 2,
                "user_id" => 1,
                "document_title" => "title1",
                "logo_img_path" => "questar.jpg",
                "status" => 0,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "business_partner_company_name" => "company1",
                "honorific_title" => "御中",
                "payment_terms" => "sample",
                "usage_period" => "sample",
                "term_and_conditions" => "sample"
            ],
            [
                "sell_part_id" => 1,
                "see_part_id" => 3,
                "customer_part_id" => 3,
                "document_type_id" => 3,
                "user_id" => 1,
                "document_title" => "title1",
                "logo_img_path" => "questar.jpg",
                "status" => 0,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "business_partner_company_name" => "company1",
                "honorific_title" => "御中",
                "payment_terms" => "sample",
                "usage_period" => "sample",
                "term_and_conditions" => "sample"
            ],
        ]);
    }
}
