<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductsListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_list')->truncate();

        DB::table('products_list')->insert([
            [
                "name" => "デジタルサイネージ販売(屋外)32インチ",
                "unit" => "個",
                "unit_price" => 550000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)43インチ",
                "unit" => "個",
                "unit_price" => 825000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)60インチ",
                "unit" => "個",
                "unit_price" => 1320000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)75インチ",
                "unit" => "個",
                "unit_price" => 2200000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)86インチ",
                "unit" => "個",
                "unit_price" => 2500000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)115インチLED",
                "unit" => "個",
                "unit_price" => 3300000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)140インチLED",
                "unit" => "個",
                "unit_price" => 3800000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)160インチLED",
                "unit" => "個",
                "unit_price" => 4300000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋内)55インチ",
                "unit" => "個",
                "unit_price" => 700000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋内)65インチ",
                "unit" => "個",
                "unit_price" => 750000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋内)74インチ",
                "unit" => "個",
                "unit_price" => 850000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋内)86インチ",
                "unit" => "個",
                "unit_price" => 1000000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋内)100インチ",
                "unit" => "個",
                "unit_price" => 1800000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)32インチ",
                "unit" => "ヶ月",
                "unit_price" => 40000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)43インチ",
                "unit" => "ヶ月",
                "unit_price" => 60000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージ販売(屋外)60インチ",
                "unit" => "ヶ月",
                "unit_price" => 100000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージレンタル(屋外)115インチLED",
                "unit" => "ヶ月",
                "unit_price" => 200000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージレンタル(屋外)140インチLED",
                "unit" => "ヶ月",
                "unit_price" => 300000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージレンタル(屋外)160インチLED",
                "unit" => "ヶ月",
                "unit_price" => 350000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージレンタル(屋内)55インチ",
                "unit" => "ヶ月",
                "unit_price" => 35000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージレンタル(屋内)65インチ",
                "unit" => "ヶ月",
                "unit_price" => 37500,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージレンタル(屋内)74インチ",
                "unit" => "ヶ月",
                "unit_price" => 42500,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージレンタル(屋内)86インチ",
                "unit" => "ヶ月",
                "unit_price" => 50000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "デジタルサイネージレンタル(屋内)100インチ",
                "unit" => "ヶ月",
                "unit_price" => 90000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "振動騒音セッティング基本料(販売)",
                "unit" => "式",
                "unit_price" => 30000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "振動騒音装置機器　TYPE3666(販売)",
                "unit" => "ヶ月",
                "unit_price" => 700000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "振動騒音クラウド利用料(販売)",
                "unit" => "ヶ月",
                "unit_price" => 3000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "簡易気象計セッティング(販売)",
                "unit" => "ヶ月",
                "unit_price" => 30000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "簡易気象計機器(販売)",
                "unit" => "ヶ月",
                "unit_price" => 200000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "簡易気象軽クラウド利用料(販売)",
                "unit" => "ヶ月",
                "unit_price" => 3000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "マイクアンプシステム(販売)",
                "unit" => "ヶ月",
                "unit_price" => 200000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "JITANSW　16局親機(販売)",
                "unit" => "式",
                "unit_price" => 350000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "JITANSW　４局子機(販売)",
                "unit" => "式",
                "unit_price" => 200000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "JITANSWセッティング基本料(販売)",
                "unit" => "式",
                "unit_price" => 50000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "JITANSW　クラウド利用料通信料16局まで(販売)",
                "unit" => "ヶ月",
                "unit_price" => 5000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "絵コンテ（マンガ作成）(販売)",
                "unit" => "枚",
                "unit_price" => 10000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "コンテンツクラウド利用料(販売)",
                "unit" => "ヶ月",
                "unit_price" => 12000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "振動騒音セッティング基本料(レンタル)",
                "unit" => "式",
                "unit_price" => 30000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "振動騒音装置機器レンタル料(レンタル)",
                "unit" => "ヶ月",
                "unit_price" => 30000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "振動騒音クラウド利用料(レンタル)",
                "unit" => "ヶ月",
                "unit_price" => 3000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "簡易気象計セッティング(レンタル)",
                "unit" => "ヶ月",
                "unit_price" => 30000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "簡易気象計機器レンタル料(レンタル)",
                "unit" => "ヶ月",
                "unit_price" => 15000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "簡易気象軽クラウド利用料(レンタル)",
                "unit" => "ヶ月",
                "unit_price" => 3000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "マイクアンプシステム(レンタル)",
                "unit" => "ヶ月",
                "unit_price" => 15000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "設定費用(レンタル)",
                "unit" => "式",
                "unit_price" => 50000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "JITANSW　クラウド利用料通信料16局まで(レンタル)",
                "unit" => "ヶ月",
                "unit_price" => 5000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "絵コンテ（マンガ作成）(レンタル)",
                "unit" => "枚",
                "unit_price" => 10000,
                "tax" => 0.1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
    }
}
