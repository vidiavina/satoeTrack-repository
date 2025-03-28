<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'no_telp' => $this->faker->numerify('08##########'),
            'password' => Hash::make('password123'), // Default password
            'role' => $this->faker->randomElement([1, 2, 3]), // Example roles
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
