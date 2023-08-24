<?php

namespace App\Http\Controllers;

use App\Models\periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['periodo'] = periodo::paginate(15);
        return view('periodo.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periodo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosPeriodo = $request->except('_token');
        periodo::insert($datosPeriodo);
        //return view('profesor.create');
        return redirect('periodo')->with('mensaje','¡Carrera agregado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show(periodo $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $periodo = periodo::findOrFail($id);
        return view('periodo.edit', compact('periodo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombre_periodo' => 'required|string|max:40',

        ];
        $mensaje =[
            'required' => 'Rellene el campo de :attribute'
        ];
        $this->validate($request, $campos, $mensaje);
        $datosPeriodo = request()->except('_token','_method');
        periodo::where('id','=',$id)->update($datosPeriodo);
        //return response()->json($datosProfesor);
        $periodo = periodo::findOrFail($id);
        return redirect('periodo')->with('mensaje','Datos modificados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            periodo::destroy($id);
            return redirect('periodo')->with('mensaje','Datos eliminados');
    }
}
