<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pacote>
 */
class PacoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'peso' => $this->faker->numberBetween(1,20),
            'altura' => $this->faker->numberBetween(1,100),
            'largura' => $this->faker->randomFloat(2,0,100),
            'profundidade' => $this->faker->randomFloat(2,0,100)
        ];
    }
}
