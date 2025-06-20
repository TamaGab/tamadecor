<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Importe o modelo Product

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(15)->create();
    }
}
