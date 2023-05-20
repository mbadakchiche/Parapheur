<?php

namespace Database\Seeders;

use App\Models\Mail;
use Illuminate\Database\Seeder;

class MailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mail::factory(50)->create();
    }
}
