<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;
use Database\Factories\PropertyFactory;
use App\Models\Property;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JobFactory extends Factory
{
    /**
     * Define Job table fake data.
     *
     * @return array<string, mixed>
     */
    public function definition(): Array
    {
        return [
            "summary" => $this->faker->text(140),
            "description" => $this->faker->text(490),
            "status" => $this->faker->randomElement(["open", "in progress", "completed", "cancelled"]),
            "property_id" =>  Property::factory(),
            "user_id" => User::factory(),
        ];
    }
}
