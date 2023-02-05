<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\ProdutoFilter;
use App\Models\Produto;
use App\Http\Requests\V1\StoreProdutoRequest;
use App\Http\Requests\V1\UpdateProdutoRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProdutoCollection;
use App\Http\Resources\V1\ProdutoResource;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdutoRequest $request)
    {
        return new ProdutoResource(Produto::create($request->all()));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdutoRequest  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
