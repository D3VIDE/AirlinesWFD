<?php

namespace Database\Factories;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_id' => \App\Models\Flight::factory(),
            'passenger_name' => $this->faker->name(),
            'passenger_phone' => $this->faker->numerify('08##########'),
            'seat_number' => strtoupper($this->faker->randomLetter) . str_pad($this->faker->numberBetween(1, 30), 2, '0', STR_PAD_LEFT), // contoh: A01
            'is_boarding' => false,
            'boarding_time' => null,
        ];
    }
}
