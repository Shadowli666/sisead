<?php

namespace App\Http\Controllers;

use App\Models\carreras;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('carreras.index');
        $datos['carreras'] = carreras::paginate(15);
        return view('carreras.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carreras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosCarreras = $request->except('_token');
        carreras::insert($datosCarreras);
        //return view('profesor.create');
        return redirect('carreras')->with('mensaje','¡Carrera agregado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function show(carreras $carreras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carreras = carreras::findOrFail($id);
        return view('carreras.edit', compact('carreras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $datosCarreras = request()->except('_token','_method');
    //     carreras::where('id','=',$id)->update($datosCarreras);
    //     $carreras = carreras::findOrFail($id);
    //     return redirect('carreras')->with('mensaje','Datos modificados');
    // }
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombre_carrera' => 'required|string|max:40',

        ];
        $mensaje =[
            'required' => 'Rellene el campo de :attribute'
        ];
        $this->validate($request, $campos, $mensaje);
        $datosCarrera = request()->except('_token','_method');
        carreras::where('id','=',$id)->update($datosCarrera);
        //return response()->json($datosProfesor);
        $carrera = carreras::findOrFail($id);
        return redirect('carreras')->with('mensaje','Datos modificados');
        //return view('profesor.edit', compact('profesor')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\carreras  $carreras
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        carreras::destroy($id);
        //return redirect('profesor');
        return redirect('carreras')->with('mensaje','Datos eliminados');
    }
}
