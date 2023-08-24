<?php

namespace App\Http\Controllers;

use App\Models\NotaEstudiantes;
use App\Models\Estudiante;
use App\Models\inscripcion_estudiantes;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use \NumberFormatter;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;


class NotaEstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodo = Periodo::pluck('nombre_periodo', 'id');
        //TODO que las masivas se traigan las solo las materias inscritas por periodo 
        return view('notas.index',compact('periodo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cedula,$periodo_id)
    {
        $periodo = Periodo::findOrFail($periodo_id);
        // Buscamos al estudiante por su cédula
        $estudiante = Estudiante::where('cedula', $cedula)->firstOrFail();
        // Validamos si el estudiante existe
        if (!$estudiante) {
            return redirect('inscripcion')->with('mensaje' , 'Estudiante no encontrado, para inscribir al estudiante al sistema ingrese <a href="'.route('estudiante.create').'">aquí</a>');
        }
        // Se obtienen las materias inscritas
        $materias_inscritas = $estudiante->inscripciones()
        ->where('periodo_id', $periodo_id)
        ->get();

        if ($materias_inscritas->isEmpty()){
            //si no se encuentran materias inscritas:
            //$materias_no_inscritas = Materias::where('carrera_id','=',$estudiante->carrera_id)->orderBy('num_trimestre','asc')->get();
            return redirect('inscripcion/create/'.$cedula)->with('mensaje','El estudiante no ha inscrito materias en el periodo '. Periodo::find($periodo_id)->nombre_periodo);  
        }
        return view('notas.create',compact('estudiante','periodo','materias_inscritas'));
        
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
        'id_inscripcion' => 'required',
        'nota1' => 'numeric|between:0,20',
        'nota2' => 'numeric|between:0,20',
        'nota3' => 'numeric|between:0,20',
    ];
    
    // Definir los mensajes personalizados para las reglas de validación
    $mensaje = [
        'required' => 'El campo :attribute es requerido',
        'numeric' => 'El campo :attribute debe ser numérico',
        'between' => 'El campo :attribute debe estar entre :min y :max',
        'nota1.between' => 'El campo Corte 1 debe estar entre :min y :max',
        'nota2.between' => 'El campo Corte 2 debe estar entre :min y :max',
        'nota3.between' => 'El campo Corte 3 debe estar entre :min y :max',
    ];
    
    // Validar el request
    $this->validate($request, $campos, $mensaje);
        $datosNotas = request()->except('_token','_method', 'nota_definitiva');
        $dummy2 = NotaEstudiantes::updateOrCreate(
            ['id_inscripcion' => $datosNotas['id_inscripcion']],//datos de busqueda
            ['id_inscripcion' => $datosNotas['id_inscripcion'],//datos que se actualizan
            'nota1'=> $datosNotas['nota1'],
            'nota2'=> $datosNotas['nota2'],
            'nota3'=> $datosNotas['nota3']
            ]
        );
        Alert::success('Información', '¡Nota agregada o modificada con éxito!');
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotaEstudiantes  $notaEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function show(NotaEstudiantes $notaEstudiantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotaEstudiantes  $notaEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaEstudiantes $notaEstudiantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotaEstudiantes  $notaEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaEstudiantes $notaEstudiantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotaEstudiantes  $notaEstudiantes
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaEstudiantes $notaEstudiantes)
    {
        //
    }

    /**
     * Obtiene todas las materias aprobadas en la carrera del estudiante
     */
    public function notasAprobadas(Request $request){
        //
        $cedula = $request->except('_token','_method');
        $estudiante = Estudiante::where('cedula', $cedula)->firstOrFail();
        if($estudiante){
            $notasAprobadas = $estudiante->notasAprobadas;
            $NumerosALetras = new \NumberFormatter("es", \NumberFormatter::SPELLOUT);
            //return view('notas.materias-aprobadas',compact('notasAprobadas','estudiante','NumerosALetras'));
            $pdf = PDF::setOptions(['defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true])
            ->loadView('notas.planilla-materias-ap',compact('notasAprobadas','estudiante','NumerosALetras'));
            return $pdf->stream('planilla_inscripcion.pdf');
        }
    }
}