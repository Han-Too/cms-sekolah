<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        return [
            'user_token' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => fake()->name(),
            'username' => fake()->name(),
            'email' => fake()->safeEmail(),
            'telepon' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'role' => "User",
            'email_verified_at' => now(),
            'password' => bcrypt("pass.123"), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
