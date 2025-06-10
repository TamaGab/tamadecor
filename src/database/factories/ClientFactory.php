<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Certifica que o CPF é único.
        // O Laravel Faker não tem um gerador de CPF por padrão, então simulamos um
        // usando o `unique()->numerify()` para garantir 11 dígitos e unicidade.
        return [
            'name' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify('###########'), // 11 dígitos
            'rg' => $this->faker->unique()->numerify('#########'), // 9 dígitos
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'notes' => $this->faker->text(200), // Notas com até 200 caracteres
        ];
    }
}
