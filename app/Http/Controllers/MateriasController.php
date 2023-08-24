<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use App\Models\Profesor;
use App\Models\Carreras;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['materias'] = Materias::paginate();
        return view('materias.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materias = new Materias();
        $carreras = carreras::pluck('nombre_carrera', 'id');
        return view('materias.create', compact('materias', 'carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosMateria = $request->except('_token');
        Materias::insert($datosMateria);
        return redirect('materias')->with('mensaje','Materia agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materias  $materias
     * @return \Illuminate\Http\Response
     */
    public function show(Materias $materias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materias  $materias
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materias = Materias::findOrFail($id);
        $carreras = carreras::pluck('nombre_carrera', 'id');
        return view('materias.edit', compact('materias','carreras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materias  $materias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosMaterias = request()->except('_token','_method');
        Materias::where('id','=',$id)->update($datosMaterias);
        //return response()->json($datosProfesor);
        $materias = Materias::findOrFail($id);
        return redirect('materias')->with('mensaje','Datos modificados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materias  $materias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Materias::destroy($id);
        //return redirect('profesor');
        return redirect('materias')->with('mensaje','Datos eliminados');
    }
}
