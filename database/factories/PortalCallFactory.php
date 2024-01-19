<?php

namespace Database\Factories;

use app\Model\PortalCall;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PortalCall>
 */
class PortalCallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PortalCall::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statusCodes = [200, 304, 603, 403, 404, 486, 484, 503, 480, 402, 423];
        return [
            'portal_id' => $this->faker->numberBetween(1, 1),
            'user_id' => $this->faker->numberBetween(1, 50),
            'portal_number' => $this->faker->randomNumber(10),
            'duration' => $this->faker->numberBetween(10, 300),
            'date' => $this->faker->dateTimeThisMonth(),
            'cost' => $this->faker->randomNumber(2),
            'cost_currency' => 'RUR',
            'type' => $this->faker->numberBetween(1, 4),
            'code' => $this->faker->randomElement($statusCodes),
        ];
    }
}
