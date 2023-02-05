<?php

namespace Database\Factories;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'nome' => $this->faker->text(),
            'categoria_pai_id' => null,
        ];
    }
}
