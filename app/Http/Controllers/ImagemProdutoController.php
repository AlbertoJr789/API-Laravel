<?php

namespace App\Http\Controllers;

use App\Models\ImagemProduto;
use App\Http\Requests\StoreImagemProdutoRequest;
use App\Http\Requests\UpdateImagemProdutoRequest;

class ImagemProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreImagemProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagemProdutoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImagemProduto  $imagemProduto
     * @return \Illuminate\Http\Response
     */
    public function show(ImagemProduto $imagemProduto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImagemProduto  $imagemProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagemProduto $imagemProduto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImagemProdutoRequest  $request
     * @param  \App\Models\ImagemProduto  $imagemProduto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImagemProdutoRequest $request, ImagemProduto $imagemProduto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImagemProduto  $imagemProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImagemProduto $imagemProduto)
    {
        //
    }
}
