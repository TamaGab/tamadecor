<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon; // Mantenha Carbon se for usar no definition, mas já não será crucial para a data

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            // order_date será sobrescrito na seeder, então pode ser um valor genérico aqui
            'order_date' => $this->faker->dateTimeBetween('-15 days', 'now')->format('Y-m-d'), // Apenas um fallback
            'total_price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
