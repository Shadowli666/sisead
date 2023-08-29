<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Carreras;
use App\Models\Materias;
use App\Models\Estudiante;
use App\Models\inscripcion_estudiantes;
use App\Models\NotaEstudiantes;
use Illuminate\Http\Request;
use App\Models\procedencia;
use App\Models\Periodo;
use Illuminate\Queue\RedisQueue;
use PDF;

use function PHPUnit\Framework\isEmpty;

class InscripcionEstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodo = Periodo::pluck('nombre_periodo', 'id');
        return view('inscripcion.index',compact('periodo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cedula, inscripcion_estudiantes $inscripcion)
    {
        $estudiante = Estudiante::where('cedula', '=', $cedula)->first();
        if($estudiante){
            /**
             * Obtiene todas las materias de la carrera que el estudiante aún no ha aprobado
             */
                $inscripciones = $estudiante->inscripciones;
                $inscripciones_aprobadas = $inscripciones->filter(function ($inscripcion) {
                    return $inscripcion->notaEstudiantes && $inscripcion->notaEstudiantes->nota_definitiva >= 10;
                });
                $materias_aprobadas = $inscripciones_aprobadas->map(function ($inscripcion) {
                    return $inscripcion->materias;
                });
                $materias = Materias::where('carrera_id','=',$estudiante->carrera_id)
                            ->whereNotIn('id', $materias_aprobadas->pluck('id'))
                            ->orderBy('num_trimestre','asc')
                            ->get();        
            /**
             * Obtiene las materias de la carrera del estudiante
             * ¡¡¡Descomentar en caso de emergencias!!!
             * $materias = Materias::where('carrera_id','=',$estudiante->carrera_id)->orderBy('num_trimestre','asc')->get();
             */
            $periodo = Periodo::pluck('nombre_periodo', 'id');
            return view('inscripcion.create', compact('inscripcion', 'estudiante', 'materias', 'periodo')); 
        }
        else {
            return redirect('inscripcion')->with('mensaje','Cédula no encontrada');
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validación de datos
        $campos = [
            'periodo_id' => 'required|integer',
            'materias'=> 'required|array|max:8', //TODO cambie esto el a max:8
            'estudiante_id' => ['required','integer',
            Rule::unique('inscripcion_estudiantes')->where(function ($query) use ($request) {
                return $query->where('periodo_id', $request->periodo_id)
                ->whereIn('materia_id', $request->materias)
                ->where('estudiante_id', $request->estudiante_id);
            })],
        ];
        $mensaje =[
            'required' => 'Rellene el campo de :attribute',
            'unique' => 'El estudiante ya se encuentra inscrito en la materia',
            'materias.required' => 'Seleccione por lo menos una materia para continuar con la inscripción',
            'materias.max:7' => 'Sólo se pueden inscribir 8 materias'
        ];
        $this->validate($request, $campos, $mensaje);
        // Obtener los datos enviados por el formulario
        $estudiante_id = $request->input('estudiante_id');
        $periodo_id = $request->input('periodo_id');
        $materias = $request->input('materias');

        // Insertar las inscripciones en la base de datos
        foreach ($materias as $materia_id) {
            inscripcion_estudiantes::create([
                'estudiante_id' => $estudiante_id,
                'materia_id' => $materia_id,
                'periodo_id' => $periodo_id,
                'created_at' => now(),
            ]);
        }
        // return response()->json($request);
        return redirect('inscripcion')->with('mensaje','Inscripción realizada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inscripcion_estudiantes  $inscripcion_estudiantes
     * @return \Illuminate\Http\Response
     */
    public function show(inscripcion_estudiantes $inscripcion_estudiantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inscripcion_estudiantes  $inscripcion_estudiantes
     * @return \Illuminate\Http\Response
     */
    public function edit($cedula, $periodo_id)
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
        return view('inscripcion.edit', compact('estudiante','periodo','materias_inscritas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inscripcion_estudiantes  $inscripcion_estudiantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inscripcion_estudiantes $inscripcion_estudiantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inscripcion_estudiantes  $inscripcion_estudiantes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        inscripcion_estudiantes::destroy($id);
        //return redirect('profesor');
        return redirect('inscripcion')->with('mensaje','Datos eliminados');
    }

    /**
     * Muestra en pdf las materias que inscribió un estudiante en el trimestre
     */
    public function planillaInscripcion(Request $request)
    {
        $request->cedula ? $cedula = $request->cedula : redirect('inscripcion')->with('mensaje','Campo de cédula vacío');
        $request->input_periodo_imprimir ? $periodo_id = $request->input_periodo_imprimir : redirect('inscripcion')->with('mensaje','Campo de período vacío');
        //obtener el id del estudiante
        $idEstudiante = Estudiante::where('cedula', '=', $cedula)->first();
        if($idEstudiante){
            //obtener el total de las uc inscritas 
            $ucInscritas = inscripcion_estudiantes::selectRaw('SUM(materias.costo_uc) as total_uc')
            ->join('materias', 'inscripcion_estudiantes.materia_id', '=', 'materias.id')
            ->join('periodos', 'inscripcion_estudiantes.periodo_id', '=', 'periodos.id')
            ->where('inscripcion_estudiantes.estudiante_id', $idEstudiante->id)
            ->where('inscripcion_estudiantes.periodo_id', $periodo_id)
            ->first();
            $data = inscripcion_estudiantes::where('estudiante_id','=',$idEstudiante->id)
            ->where('periodo_id',$periodo_id)
            ->get();
            $carreras = Carreras::get();
            $procedencias = procedencia::get();
            if($data->isEmpty()){
                return redirect('inscripcion')->with('mensaje','El estudiante no ha inscrito materias');
            }
            //$pdf = \PDF::loadView('inscripcion.planilla',compact('data','ucInscritas','procedencias','carreras'))->setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            $pdf = PDF::setOptions(['defaultFont' => 'sans-serif',
                            'isHtml5ParserEnabled' => true,
                            'isRemoteEnabled' => true])
                            ->loadView('inscripcion.planilla',compact('data','ucInscritas','procedencias','carreras'));
            return $pdf->stream('planilla_inscripcion.pdf');
        }
        else{
            return redirect('inscripcion')->with('mensaje','Cédula no encontrada');
        }
    }
}