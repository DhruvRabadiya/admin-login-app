<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name, // Generating full name using the fake() function
            'user_name' => fake()->userName, // Generating user name using the fake() function
            'email' => fake()->unique()->safeEmail, // Generating email using the fake() function
            'password' => bcrypt('password'), // You may generate a hashed password or use a plain text one for testing purposes
            'mobile_number' => fake()->phoneNumber, // Generating phone number using the fake() function
            'date_of_birth' => fake()->date($format = 'Y-m-d', $max = '2000-01-01'),
        ];
    }
}
