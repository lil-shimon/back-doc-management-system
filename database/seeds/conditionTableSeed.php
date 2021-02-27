<?php

use Illuminate\Database\Seeder;
use App\Condition;

class conditionTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Condition::class, 3)->create();
    }
}
