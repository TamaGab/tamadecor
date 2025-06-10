<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Client;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon; // Adicionado para usar Carbon

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pt_BR');

        if (Client::count() === 0) {
            $this->call(ClientSeeder::class);
        }
        if (Product::count() === 0) {
            $this->call(ProductSeeder::class);
        }

        $clients = Client::all();
        $products = Product::all();

        // --- NOVA LÓGICA DE GERAÇÃO DE PEDIDOS POR DIA ---
        $daysToSeed = 15; // Gerar pedidos para os últimos 15 dias
        $minOrdersPerDay = 3;
        $maxOrdersPerDay = 5;

        // Loop pelos últimos 15 dias (do mais antigo para o mais recente)
        for ($i = $daysToSeed - 1; $i >= 0; $i--) { // Começa 14 dias atrás e vai até hoje
            $currentDate = Carbon::today()->subDays($i)->format('Y-m-d');
            $ordersForThisDay = mt_rand($minOrdersPerDay, $maxOrdersPerDay);

            // Cria de 2 a 3 pedidos para a data atual
            for ($j = 0; $j < $ordersForThisDay; $j++) {
                // Cria a ordem
                $order = Order::factory()->make([ // Use make() aqui
                    'client_id' => $clients->random()->id,
                    'order_date' => $currentDate, // Define a data explicitamente
                    'total_price' => 0, // Inicia com 0, será atualizado pelos itens
                ]);
                $order->save(); // Salva a ordem para obter um ID

                $totalPrice = 0;
                $numberOfItems = mt_rand(1, 5); // Cada ordem terá entre 1 e 5 itens

                for ($k = 0; $k < $numberOfItems; $k++) {
                    $product = $products->random(); // Pega um produto aleatório
                    $quantity = mt_rand(1, 3);      // Quantidade do item
                    $price = $faker->randomFloat(2, 10, 500); // Preço unitário do item

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);

                    $totalPrice += ($quantity * $price);
                }

                // Atualiza o total_price da ordem após adicionar os itens
                $order->update(['total_price' => $totalPrice]);
            }
        }
    }
}
