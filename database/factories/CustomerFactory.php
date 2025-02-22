<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name;
        $email = strtolower(str_replace(' ', '.', $name)) . '@exemplo.com';

        return [
            'name'  => $name,
            'email' => $email,
            'city'  => fake()->city
        ];
    }
}
