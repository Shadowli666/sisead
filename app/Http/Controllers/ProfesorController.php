<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\Materias;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['profesor'] = Profesor::paginate(10);
        return view('profesor.index', $datos);
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
        return view('profesor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'nombres' => 'required|string|max:40',
            'apellidos '=> 'string|max:40',
            'correo' => 'required|email',
            'telefono' => 'required'
        ];
        $mensaje =[
            'required' => 'Rellene el campo de :attribute'
        ];
        $this->validate($request, $campos, $mensaje);
        $datosProfesor = $request->except('_token');
        Profesor::insert($datosProfesor);
        //return view('profesor.create');
        return redirect('profesor')->with('mensaje','Profesor agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $profesor = Profesor::findOrFail($id);
        return view('profesor.edit', compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombres' => 'required|string|max:40',
            'apellidos '=> 'string|max:40',
            'correo' => 'required|email',
            'telefono' => 'required'
        ];
        $mensaje =[
            'required' => 'Rellene el campo de :attribute'
        ];
        $this->validate($request, $campos, $mensaje);
        $datosProfesor = request()->except('_token','_method');
        Profesor::where('id','=',$id)->update($datosProfesor);
        //return response()->json($datosProfesor);
        $profesor = Profesor::findOrFail($id);
        return redirect('profesor')->with('mensaje','Datos modificados');
        //return view('profesor.edit', compact('profesor')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Profesor::destroy($id);
        //return redirect('profesor');
        return redirect('profesor')->with('mensaje','Datos eliminados');

    }

    public function editSubject()
    {
        $datos['materias'] = Materias::paginate(15);
        $datos['profesor'] = Profesor::pluck('nombres', 'id');
        return view('profesor.assing', $datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */

    public function storeSubject(Request $request  ,$id)
    {   
        $datosProfesor = request()->except('_token','_method');
        Materias::where('id','=',$id)->update($datosProfesor);
        return redirect('profesor/edit/subject')->with('mensaje','Datos modificados');
    }
}
