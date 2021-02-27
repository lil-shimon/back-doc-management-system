<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->truncate();

        DB::table('companies')->insert([
            [
                "type" => 100,
                "name" => "hoge株式会社",
                "post_code" => "100-0005",
                "pref" => "東京都",
                "address" => "東京都千代田区丸の内1丁目",
                "tel" => "090-1234-5678",
                "fax" => "050-1234-5678",
                "parent_id" => Null,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            // [
            //     "type" => 200,
            //     "name" => "fuga株式会社",
            //     "post_code" => "279-0031",
            //     "pref" => "千葉県",
            //     "address" => "千葉県浦安舞浜1-1",
            //     "tel" => "080-1234-5678",
            //     "fax" => "050-2345-6789",
            //     "parent_id" => Null,
            //     "created_at" => Carbon::now(),
            //     "updated_at" => Carbon::now(),
            // ],
            // [
            //     "type" => 300,
            //     "name" => "huwa株式会社",
            //     "post_code" => "330-0061",
            //     "pref" => "埼玉県",
            //     "address" => "埼玉県さいたま市浦和区常磐9丁目30-1",
            //     "tel" => "070-4321-5678",
            //     "fax" => "050-4321-5678",
            //     "parent_id" => 3,
            //     "created_at" => Carbon::now(),
            //     "updated_at" => Carbon::now(),
            // ],
        ]);
    }
}
