<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\Carreras;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['seccion'] = Seccion::paginate(15);
        return view('seccion.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $seccion = new Seccion();
        $carreras = Carreras::pluck('nombre_carrera', 'id');
        return view('seccion.create', compact('carreras','seccion'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $rules = [
        'codigo_seccion' => 'required|string|max:15|unique:seccions',
        'num_trimestre' => 'required|integer',
        'carrera_id' => 'required|integer',
    ];

    $messages = [
        'unique' => 'El campo :attribute ya se encuentra registrado',
        'required' => 'El campo :attribute es obligatorio.',
        'integer' => 'El campo :attribute debe ser un número entero.',
        'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    ];

    $this->validate($request, $rules, $messages);

    $datosSeccion = $request->except('_token');
    Seccion::insert($datosSeccion);
    Alert::success('Información', 'Sección agregada o modificada con éxito!');
    return redirect('seccion')->with('mensaje', 'Sección agregada con éxito');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function show(Seccion $seccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seccion = Seccion::findOrFail($id);
        $carreras = carreras::pluck('nombre_carrera', 'id');
        return view('seccion.edit', compact('seccion','carreras'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'codigo_seccion' => 'required|string|max:15|unique:seccions,codigo_seccion,'.$id.',id,num_trimestre,'.$request->num_trimestre,
            'num_trimestre' => 'required|integer',
            'carrera_id' => 'required|integer',
        ];
    
        $messages = [
            'unique' => 'El campo :attribute ya se encuentra registrado',
            'required' => 'El campo :attribute es obligatorio.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
        ];
    
        $this->validate($request, $rules, $messages);
    
        $datosSeccion = $request->except('_token','_method');
        Seccion::where('id','=',$id)->update($datosSeccion);
        return redirect('seccion')->with('mensaje', 'Sección agregada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seccion $seccion)
    {
        //
    }
}
