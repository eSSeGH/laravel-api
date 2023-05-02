<?php

namespace App\Http\Controllers;

use App\Models\technologies;
use App\Http\Requests\StoretechnologiesRequest;
use App\Http\Requests\UpdatetechnologiesRequest;

class TechnologiesController extends Controller
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
     * @param  \App\Http\Requests\StoretechnologiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretechnologiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\technologies  $technologies
     * @return \Illuminate\Http\Response
     */
    public function show(technologies $technologies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\technologies  $technologies
     * @return \Illuminate\Http\Response
     */
    public function edit(technologies $technologies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetechnologiesRequest  $request
     * @param  \App\Models\technologies  $technologies
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetechnologiesRequest $request, technologies $technologies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\technologies  $technologies
     * @return \Illuminate\Http\Response
     */
    public function destroy(technologies $technologies)
    {
        //
    }
}
