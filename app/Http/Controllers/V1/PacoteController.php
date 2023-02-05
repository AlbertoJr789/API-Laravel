<?php

namespace App\Http\Controllers\V1;

use App\Models\Pacote;
use App\Http\Requests\V1\StorePacoteRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UpdatePacoteRequest;
use App\Http\Resources\V1\PacoteCollection;

class PacoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PacoteCollection(Pacote::paginate());
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
     * @param  \App\Http\Requests\StorePacoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePacoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pacote  $pacote
     * @return \Illuminate\Http\Response
     */
    public function show(Pacote $pacote)
    {
        return $pacote;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pacote  $pacote
     * @return \Illuminate\Http\Response
     */
    public function edit(Pacote $pacote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePacoteRequest  $request
     * @param  \App\Models\Pacote  $pacote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacoteRequest $request, Pacote $pacote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pacote  $pacote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pacote $pacote)
    {
        //
    }
}
