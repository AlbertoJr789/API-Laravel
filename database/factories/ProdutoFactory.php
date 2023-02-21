<?php

namespace Database\Factories;

use App\Models\Pacote;
use App\Models\Produto;
use App\Models\SeoProduto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->text(20),
            'descricao' => $this->faker->text(30),
            'marca' => $this->faker->text(10),
            'preco_custo' => $this->faker->randomFloat(2,0,20000),
            'preco_venda' => $this->faker->randomFloat(2,0,20000),
            'preco_promocional' => $this->faker->randomFloat(2,0,20000),
            'situacao' => $this->faker->numberBetween(0,1),
            'estoque' => $this->faker->numberBetween(0,100),
            'sob_consulta' => $this->faker->boolean(),
            'gtin' => str($this->faker->numberBetween(1111111)),
            'mpn' => str($this->faker->numberBetween(1111111)),
            'ncm' => str($this->faker->numberBetween(1111111)),
            'disponibilidade' => $this->faker->numberBetween(0,30),
            'link_video' => $this->faker->url(),
            'pacote_id' => Pacote::factory(),
            'seo_id' => SeoProduto::factory()
        ];
    }
}
