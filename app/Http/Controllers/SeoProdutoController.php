<?php

namespace App\Http\Controllers;

use App\Models\SeoProduto;
use App\Http\Requests\StoreSeoProdutoRequest;
use App\Http\Requests\UpdateSeoProdutoRequest;

class SeoProdutoController extends Controller
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
     * @param  \App\Http\Requests\StoreSeoProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeoProdutoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeoProduto  $seoProduto
     * @return \Illuminate\Http\Response
     */
    public function show(SeoProduto $seoProduto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeoProduto  $seoProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(SeoProduto $seoProduto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeoProdutoRequest  $request
     * @param  \App\Models\SeoProduto  $seoProduto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeoProdutoRequest $request, SeoProduto $seoProduto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeoProduto  $seoProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeoProduto $seoProduto)
    {
        //
    }
}
