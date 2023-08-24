<?php

namespace App\Http\Controllers;

use App\Models\params;
use Illuminate\Http\Request;

class ParamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('params.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\params  $params
     * @return \Illuminate\Http\Response
     */
    public function show(params $params)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\params  $params
     * @return \Illuminate\Http\Response
     */
    public function edit(params $params)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\params  $params
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, params $params)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\params  $params
     * @return \Illuminate\Http\Response
     */
    public function destroy(params $params)
    {
        //
    }
    public function yuca(params $params)
    {
        //
    }
}
