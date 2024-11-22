<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'position' => $this->faker->jobTitle,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['0', '1']),
            'phone' => $this->faker->phoneNumber,
            'born' => $this->faker->dateTimeBetween('-60 years', '-20 years')->format('Y-m-d'),
            'photo' => $this->faker->imageUrl(640, 480, 'people', true, 'Photo'),
        ];
    }
}
