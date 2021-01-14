<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insertOrIgnore([
			['code' => 'ua', 'name' => 'Ukraine'],
			['code' => 'uk', 'name' => 'United Kingdom'],
			['code' => 'us', 'name' => 'United States'],
		]);
    }
}
