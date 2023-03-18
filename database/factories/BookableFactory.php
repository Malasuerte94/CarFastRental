<?php

namespace Database\Factories;

use App\Models\Bookable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class BookableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $suffix = [
            'Villa',
            'House',
            'Cottage',
            'Luxury Villa',
            'Rooms',
            'Cheap Rooms'
        ];

        return [
            'title' => $this->faker->city() . ' ' . Arr::random($suffix),
            'description' => $this->faker->text(),
            'price' => random_int(15, 600),
            'main_image' => $this->faker->imageUrl(300, 200)
        ];
    }
}
