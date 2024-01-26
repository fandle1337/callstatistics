<?php

namespace Database\Factories;

use App\Models\PortalCall;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortalCallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PortalCall::class;

    public function definition(): array
    {
        $statusCodes = [200, 304, 603, 403, 404, 486, 480, 402, 423];
        $phoneNumbers = [9111111111, 9222222222, 9333333333];
        $currencies = ['RUR', 'USD', 'EUR'];
        return [
            'portal_id' => $this->faker->numberBetween(1, 1),
            'call_id' => $this->faker->numberBetween(1, 10000),
            'user_id' => $this->faker->numberBetween(1, 3),
            'portal_number' => $this->faker->randomElement($phoneNumbers),
            'duration' => $this->faker->numberBetween(10, 300),
            'date' => $this->faker->dateTimeBetween('-1 year'),
            'cost' => $this->faker->randomNumber(2),
            'cost_currency' => $this->faker->randomElement($currencies),
            'type_id' => $this->faker->numberBetween(1, 2),
            'code_id' => $this->faker->randomElement($statusCodes),
        ];
    }
}
