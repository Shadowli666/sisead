<?php

namespace App\Http\Controllers;

use App\Models\SeccionMateria;
use App\Models\periodo;
use App\Models\carreras;
use App\Models\Seccion;
use Illuminate\Http\Request;

class SeccionMateriaController extends Controller
{

    public function listaSeccionesPorCarrera($id_carrera) {
        return Seccion::select('id','codigo_seccion')
        ->where('carrera_id','=',$id_carrera)
        ->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['lista_periodos'] = periodo::select('id', 'nombre_periodo')->get();
        $datos['lista_carreras'] = carreras::select('id','nombre_carrera')->get();
        return view('seccion.asignar.index', $datos);
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
     * @param  \App\Models\SeccionMateria  $SeccionMateria
     * @return \Illuminate\Http\Response
     */
    public function show(SeccionMateria $SeccionMateria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeccionMateria  $SeccionMateria
     * @return \Illuminate\Http\Response
     */
    public function edit(SeccionMateria $SeccionMateria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeccionMateria  $SeccionMateria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeccionMateria $SeccionMateria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeccionMateria  $SeccionMateria
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeccionMateria $SeccionMateria)
    {
        //
    }
}
