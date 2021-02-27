<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            SeePartTableSeeder::class,
            SellPartTableSeeder::class,
            CustomerPartTableSeeder::class,
            DocumentsTypesTableSeeder::class,
            CompaniesTableSeeder::class,
            UsersTableSeeder::class,
            // DocumentsTableSeeder::class,
            // PurchasedProductTableSeeder::class,
            // PurchasedPostageTableSeeder::class,
            // ContractedCompanyTableSeeder::class,
            ProductsListTableSeeder::class,
            PostagesListTableSeeder::class,
            CompanyLogoTableSeeder::class,
            AttachmentTableSeeder::class,
            conditionTableSeed::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            OrderTableSeeder::class,
            OrderItemTableSeeder::class,
        ]);
    }
}
