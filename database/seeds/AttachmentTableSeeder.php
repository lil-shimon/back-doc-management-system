<?php

use Illuminate\Database\Seeder;
use App\Attachment;

class AttachmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Attachment::class, 30)->create();
    }
}
