<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdjectiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->domainWord(),
            'icon' => $this->faker->imageUrl(50, 50),
        ];
    }
}
