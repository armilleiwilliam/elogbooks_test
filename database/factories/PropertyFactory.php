<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define properties table fake data.
     *
     * @return array<string, mixed>
     */
    public function definition(): Array
    {
        return [
            "name" => $this->faker->company()
        ];
    }
}
