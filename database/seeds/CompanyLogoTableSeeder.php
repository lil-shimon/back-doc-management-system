<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanyLogoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies_logoes')->truncate();

        DB::table('companies_logoes')->insert([
            // [
            //     "name" => "logo1",
            //     "img_path" => "bluebird_enjou_1.png",
            //     "created_at" => Carbon::now(),
            //     "updated_at" => Carbon::now(),
            // ],
            // [
            //     "name" => "logo2",
            //     "img_path" => "bluebird_enjou_2.png",
            //     "created_at" => Carbon::now(),
            //     "updated_at" => Carbon::now(),
            // ],
            // [
            //     "name" => "logo3",
            //     "img_path" => "bluebird_enjou_3.png",
            //     "created_at" => Carbon::now(),
            //     "updated_at" => Carbon::now(),
            // ],
            [
                "name" => "questar1",
                "img_path" => "questar.jpg",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
