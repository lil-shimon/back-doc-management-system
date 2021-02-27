<?php

use Illuminate\Database\Seeder;

class ContractedCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contracted_companies')->truncate();

        DB::table('contracted_companies')->insert([
            [
                "document_id" => 1,
                "name" => "hoge株式会社",
                "honorific_title" => "御中",
            ],
            [
                "document_id" => 2,
                "name" => "fuga株式会社",
                "honorific_title" => "御中",
            ],
            [
                "document_id" => 3,
                "name" => "huwa株式会社",
                "honorific_title" => "御中",
            ],
        ]);
    }
}
