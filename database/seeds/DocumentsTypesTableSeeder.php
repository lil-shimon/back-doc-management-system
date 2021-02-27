<?php

use Illuminate\Database\Seeder;

class DocumentsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents_types')->truncate();

        $type_name = ["請求書", "納品書", "見積書", "領収書"];
        foreach ($type_name as $name) {
            DB::table('documents_types')->insert([
                "name" => $name
            ]);
        }
    }
}
