<?php

use Illuminate\Database\Seeder;

class SeePartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('see_part')->truncate();

        $see_name = ["F", "A", "K", "J", "C"];
        foreach ($see_name as $name) {
            DB::table('see_part')->insert([
                "name" => $name
            ]);
        }
    }
}
