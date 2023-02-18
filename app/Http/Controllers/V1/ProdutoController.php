<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\ProdutoFilter;
use App\Models\Produto;
use App\Http\Requests\V1\ProdutoRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProdutoCollection;
use App\Http\Resources\V1\ProdutoResource;
use App\Models\Categoria;
use App\Models\ImagemProduto;
use App\Models\Pacote;
use App\Models\SeoProduto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request => Dados de Filtro
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new ProdutoFilter();
        $filterItems = $filter->transform($request);

        $produtos = Produto::where($filterItems);

        //carregar as categorias apenas quando o usuário pedir
        if ($request->query('categorias')) {
            $produtos = $produtos->with('categoria');
        }

        return new ProdutoCollection($produtos->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $data = $request->all();

        if (!is_numeric($data['pacote'])) {
            $data['pacote_id'] = Pacote::create($data['pacote'])->id;
        }

        $data['seo_id'] = SeoProduto::create($data['seo'])->id;
        $produto = Produto::create($data);

        //processando as imagens
        if (isset($data['imagem'])) {
            foreach ($data['imagem'] as $img) {
                ImagemProduto::create([
                    'url' => $img['url'],
                    'produto_id' => $produto->id
                ]);
            }
        }

        //processando as categorias
        if (isset($data['categoria'])) {
            foreach ($data['categoria'] as $categoria) {
                if (isset($categoria['id'])) {
                    $produto->Categoria()->attach($categoria['id']);
                } else { //significa que usuario está criando nova categoria pelo request
                    if (!is_numeric($categoria['categoriaPai']) && $categoria['categoriaPai'] != null) {
                        //significa que usuario também está criando um novo pai pra Categoria pelo request
                        $produto->Categoria()->attach($this->criarCategoriaPai($categoria, $categoria['categoriaPai']));
                    } else {
                        $produto->Categoria()->attach(Categoria::create($categoria)->id);
                    }
                }
            }
        }
        return new ProdutoResource(Produto::with('categoria')->find($produto->id));
    }

    /** Cria categorias uma dentro da outra de forma recursiva
     * @param $categoria
     * @return $categoria_id
     */
    private function criarCategoriaPai($categoria, $pai)
    {
        //criando categorias recursivamente (caso uma categoria tenha um pai e o pai tenha também o pai e assim por diante...)
        return Categoria::create([
            'nome' => strtolower($categoria['nome']),
            'categoria_pai_id' => (isset($pai['id']) || !$pai)
                ? $pai['id'] ?? null
                : $this->criarCategoriaPai($pai, $pai['categoriaPai'])
        ])->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //carregar as categorias apenas quando o usuário pedir
        return request()->query('categorias')
            ? new ProdutoResource($produto->loadMissing('categoria'))
            : new ProdutoResource($produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProdutoRequest  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, Produto $produto)
    {
        $data = $request->all();

        if (!is_numeric($data['pacote'])) {
            $data['pacote_id'] = Pacote::create($data['pacote'])->id;
        }

        //processando as imagens
        if (isset($data['imagem'])) {
            $produto->Imagem()->delete();
            foreach ($data['imagem'] as $img) {
                ImagemProduto::create([
                    'url' => $img['url'],
                    'produto_id' => $produto->id
                ]);
            }
        }

        //processando as categorias
        if (isset($data['categoria'])) {
            $detach = true;
            foreach ($data['categoria'] as $categoria) {
                if (isset($categoria['id'])) {
                    $produto->Categoria()->sync($categoria['id'], $detach);
                } else { //significa que usuario está criando nova categoria pelo request
                    if (!is_numeric($categoria['categoriaPai']) && $categoria['categoriaPai'] != null) {
                        //significa que usuario também está criando um novo pai pra Categoria pelo request
                        $produto->Categoria()->sync($this->criarCategoriaPai($categoria, $categoria['categoriaPai']), $detach);
                    } else {
                        $produto->Categoria()->sync(Categoria::create($categoria)->id, $detach);
                    }
                }
                $detach = false;
            }
        }

        $produto->Seo()->update($data['seo']);
        $data['seo_id'] = $produto->seo_id;
        $produto->update($data);
        return new ProdutoResource($produto->loadMissing('categoria'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->Seo()->delete();
        $produto->Imagem()->delete();
        $produto->Categoria()->updateExistingPivot($produto->Categoria()->pluck('id'),['deleted_at' => now()]);
        $produto->delete();
    }
}
