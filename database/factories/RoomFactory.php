<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Living Room', 'Bedroom', 'Kitchen', 'Bathroom', 'Office', 'Balcony', 'Garden']),
            'user_id' => User::factory(),
        ];
    }
}
