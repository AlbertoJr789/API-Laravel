<?php

namespace Database\Factories;

use App\Models\SeoProduto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeoProduto>
 */
class SeoProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->text(30),
            'link' => $this->faker->url(),
            'descricao' => $this->faker->text()
        ];
    }
}
