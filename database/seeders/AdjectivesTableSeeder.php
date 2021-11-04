<?php

namespace Database\Seeders;

use App\Models\Adjective;
use App\Models\Bookable;
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

        $adjectives = Adjective::all();

        Bookable::all()->each(function ($bookable) use ($adjectives) {
            $bookable->adjectives()->attach(
                $adjectives->random(rand(6, 12))->pluck('id')->toArray()
            );
        });
    }
}
