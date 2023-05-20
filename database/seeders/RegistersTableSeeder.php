<?php

namespace Database\Seeders;

use App\Models\Register;
use Illuminate\Database\Seeder;

class RegistersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Register::factory(4)->create();
    }
}
