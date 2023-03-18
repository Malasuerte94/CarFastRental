<?php

namespace Database\Seeders;

use App\Models\Adjective;
use App\Models\Bookable;
use App\Models\BookableAdjective;
use Illuminate\Database\Seeder;

class BookableAdjectivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $adjectives = Adjective::all();

        // Bookable::all()->each(function ($bookable) use ($adjectives) {
        //     $bookable->adjective()->attach(
        //         $adjectives->random(rand(6, 12))->pluck('id')->toArray(),
        //         ['value' => random_int(1, 9)]
        //     );
        // });



        // Bookable::all()->each(function (Bookable $bookable) use ($createdAdjectives) {

        //     //$adjectives = BookableAdjective::factory(random_int(3, 12))->make();
        //     //$bookable->adjective()->saveMany($adjectives);
        // });

        Bookable::all()->each(function ($bookable) {
            Adjective::all()->each(function ($adjective) use ($bookable) {
                $bookableAdjective = BookableAdjective::factory()->make();
                $bookableAdjective->bookable_id = $bookable->id;
                $bookableAdjective->adjective_id = $adjective->id;
                $bookableAdjective->save();
            });
        });
    }
}
