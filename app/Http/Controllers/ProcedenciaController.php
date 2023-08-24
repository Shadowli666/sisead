<?php

namespace App\Http\Controllers;

use App\Models\procedencia;
use Illuminate\Http\Request;

class ProcedenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['procedencia'] = procedencia::paginate(15);
        return view('procedencia.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procedencia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosProcedencia = $request->except('_token');
        procedencia::insert($datosProcedencia);
        //return view('profesor.create');
        return redirect('procedencia')->with('mensaje','¡Procedencia agregado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\procedencia  $procedencia
     * @return \Illuminate\Http\Response
     */
    public function show(procedencia $procedencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\procedencia  $procedencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procedencia = procedencia::findOrFail($id);
        return view('procedencia.edit', compact('procedencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\procedencia  $procedencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombre_procedencia' => 'required|string|max:40',

        ];
        $mensaje =[
            'required' => 'Rellene el campo de :attribute'
        ];
        $this->validate($request, $campos, $mensaje);
        $datosProcedencia = request()->except('_token','_method');
        procedencia::where('id','=',$id)->update($datosProcedencia);
        $procedencia = procedencia::findOrFail($id);
        return redirect('procedencia')->with('mensaje','Datos modificados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\procedencia  $procedencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        procedencia::destroy($id);
            return redirect('procedencia')->with('mensaje','Datos eliminados');
    }
}
