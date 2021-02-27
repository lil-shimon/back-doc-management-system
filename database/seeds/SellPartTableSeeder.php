<?php

use Illuminate\Database\Seeder;

class SellPartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sell_part')->truncate();

        $sell_name = ["S", "R"];
        foreach ($sell_name as $name) {
            DB::table('sell_part')->insert([
                    "name" => $name
            ]);
        }
    }
}
