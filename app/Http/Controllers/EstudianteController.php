<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Carreras;
use App\Models\Procedencia;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Monolog\Handler\WhatFailureGroupHandler;
use PDF;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiante.index', compact('estudiantes'));
        //return view('estudiante.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estudiante = new Estudiante();
        $carrera = Carreras::pluck('nombre_carrera', 'id');
        $procedencia = Procedencia::pluck('nombre_procedencia', 'id');
        $periodo = Periodo::pluck('nombre_periodo', 'id');
        return view('estudiante.create', compact('estudiante', 'carrera', 'procedencia','periodo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // Definir las reglas de validación
    $campos = [
        'cedula' => 'numeric|required|unique:estudiantes,cedula',
        "carrera_id" => 'numeric|required',
        'procedencia_id' => 'numeric|required',
        'periodo_inscripcion_id' => 'numeric|required',
        'primer_nombre' => 'string|required',
        'segundo_nombre' => 'string',
        'primer_apellido' => 'string|required',
        'segundo_apellido' => 'string',
        'pais' => 'string|required',
        'correo' => 'string|required|unique:estudiantes,correo',
        'telefono1' => 'numeric',
        'telefono2' => 'numeric',
        'nom_representante' => 'string',
        'correo_representante' => 'string',
        'tel_representante' => 'numeric'
    ];
    // Definir los mensajes personalizados para las reglas de validación
    $mensaje = [
        'required' => 'El campo :attribute es requerido',
        'numeric' => 'El campo :attribute debe ser numérico',
        'string' => 'El campo :attribute debe ser texto'
    ];
    // Validar el request
    $this->validate($request, $campos, $mensaje);
        $datosEstudiante = $request->except('_token');
        Estudiante::insert($datosEstudiante);
        return redirect('estudiante')->with('mensaje','Estudiante agregado con éxito');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($cedula)
    {
        $estudiante = Estudiante::select('*')
        ->where('cedula','=',$cedula)
        ->first();
        if ($estudiante){
            $carrera = carreras::pluck('nombre_carrera', 'id');
            $procedencia = Procedencia::pluck('nombre_procedencia', 'id');
            $periodo = Periodo::pluck('nombre_periodo', 'id');
            return view('estudiante.edit',compact('estudiante','carrera','procedencia','periodo'));
        }
        else{
            return redirect('estudiante')->with('mensaje','Cédula no encontrada');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO Validar datos
        $datosEstudiante = request()->except('_token','_method');
        Estudiante::where('id','=',$id)->update($datosEstudiante);
        //return response()->json($datosProfesor);
        $estudiante = Estudiante::findOrFail($id);
        return redirect('estudiante')->with('mensaje','Datos modificados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
    public function generatePDF()
    {
          
        $pdf = PDF::loadView('estudiante.index'/*, $data*/)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream('planilla_inscripcion.pdf');
    }
}