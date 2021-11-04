<?php

namespace Database\Seeders;

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
        //\App\Models\Bookable::factory(100)->create();
        //\App\Models\Booking::factory(100)->make();

        $this->call([
            UsersTableSeeder::class,
            BookablesTableSeeder::class,
            BookingsTableSeeder::class,
            ReviewsTableSeeder::class,
            AdjectivesTableSeeder::class,
            BookableAdjectivesSeeder::class,
            PickupAndReturnPointsTableSeeder::class
        ]);
    }
}
