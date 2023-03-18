<?php

namespace Database\Seeders;

use App\Models\PickupAndReturnPoint;
use Illuminate\Database\Seeder;

class PickupAndReturnPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PickupAndReturnPoint::factory()->count(8)->create();
    }
}
