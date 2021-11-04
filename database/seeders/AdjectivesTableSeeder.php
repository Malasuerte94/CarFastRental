<?php

namespace Database\Seeders;

use App\Models\Adjective;
use Illuminate\Database\Seeder;

class AdjectivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adjective::factory()->count(20)->create();
    }
}
