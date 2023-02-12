<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->realText(100),
            'enable' => $this->faker->boolean(),
        ];
    }
}
