<?php

use Illuminate\Database\Seeder;

class CustomerPartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_part')->truncate();

        $customer_name = ["G", "A", "R"];
        foreach ($customer_name as $name) {
            DB::table('customer_part')->insert([
                    "name" => $name
            ]);
        }
    }
}
