<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PickupAndReturnPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'address' => $this->faker->address(),
            'name' => $this->faker->city() . ', ' . $this->faker->state(),
            'coordinates' => $this->faker->latitude() . ', ' . $this->faker->longitude(),
        ];
    }
}
