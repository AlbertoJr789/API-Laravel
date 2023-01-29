<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = Categoria::factory(5)->create();
        
        Produto::factory(10)
            ->hasPacote()
            ->hasSeo()
            ->hasImagem(2)
            ->create()
            ->each(function($p) use ($categorias){
                $p->Categoria()->attach($categorias->random(2));
            });
        
        Produto::factory(2)
               ->trashed()
               ->create();

    }
}
