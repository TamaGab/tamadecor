<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;    // Importe o modelo Order
use App\Models\Product;  // Importe o modelo Product
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // order_id e product_id serão preenchidos na seeder para garantir a validade dos IDs.
            // Aqui, para a factory poder ser usada isoladamente, associamos a novas instâncias.
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 5), // Quantidade entre 1 e 5
            'price' => $this->faker->randomFloat(2, 5, 200), // Preço unitário entre 5 e 200
        ];
    }
}
