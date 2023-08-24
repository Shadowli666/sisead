@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - NOTAS</h1>
    </div>
    <div class="container">
        <div class="form-container container my-5">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </ul>
            </div>
            @endif
            @if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show my-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong><i class="fa-solid fa-circle-info"></i> {!!Session::get('mensaje')!!}</strong>
        </div>
        @endif
            <div class="row my-2 g-2">
                <div class="col">
                    <h3 class="fs-4">Nombre del Alumno:</h3>
                    <p class="fs-5">
                        {{$estudiante->primer_nombre ." ". $estudiante->segundo_nombre." ". $estudiante->primer_apellido." ".$estudiante->segundo_apellido}}
                    </p>
                </div>
                <div class="col">
                    <h3 class="fs-4">Carrera: </h3>
                    <p class="fs-5">
                        {{$estudiante->carrera->nombre_carrera}}
                    </p>
                </div>
                <div class="col">
                    <h3 class="fs-4">Periodo:</h3>
                    <p class="fs-5">
                        {!!$periodo->nombre_periodo!!}
                    </p>
                    <div class="mb-3">
                        <label class="visually-hidden" for="estudiante_id">ID del Estudiante</label>
                        <input type="hidden" class="form-control" name="estudiante_id" id="estudiante_id"
                            value="{{$estudiante->id}}">
                    </div>
                </div>
            </div>
            <hr>
            <h2>Lista de Materias Inscritas</h2>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Materia</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Corte 1</th>
                        <th scope="col">Corte 2</th>
                        <th scope="col">Corte 3</th>
                        <th scope="col">Nota Final</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materias_inscritas as $materia_inscrita)
                    <form method="POST" action="{{url('/notas')}}">
                        @csrf
                        <input type="hidden" name="id_inscripcion" value="{{$materia_inscrita->id}}">
                        <tr>
                            <td>
                                {{$materia_inscrita->materias->nombre_materia}}
                            </td>
                            <td>
                                {{$materia_inscrita->materias->profesor?->nombres}}
                            </td>
                            <td>
                                <input type="number" class="form-control" name="nota1" id="nota1"
                                    placeholder="0,00 - 20,00"
                                    value="{{isset($materia_inscrita->notaEstudiantes->nota1)?$materia_inscrita->notaEstudiantes->nota1:old('$materia_inscrita->notaEstudiantes->nota1')}}"
                                    step=0.01>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="nota2" id="nota2"
                                    placeholder="0,00 - 20,00"
                                    value="{{isset($materia_inscrita->notaEstudiantes->nota2)?$materia_inscrita->notaEstudiantes->nota2:old('$materia_inscrita->notaEstudiantes->nota2')}}"
                                    step=0.01>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="nota3" id="nota3"
                                    placeholder="0,00 - 20,00"
                                    value="{{isset($materia_inscrita->notaEstudiantes->nota3)?$materia_inscrita->notaEstudiantes->nota3:old('$materia_inscrita->notaEstudiantes->nota3')}}"
                                    step=0.01>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="nota_definitiva" id="nota_definitiva"
                                    placeholder="0,00 - 20,00" disabled
                                    value="{{isset($materia_inscrita->notaEstudiantes->nota_definitiva)?$materia_inscrita->notaEstudiantes->nota_definitiva:old('$materia_inscrita->notaEstudiantes->nota_definitiva')}}">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </button>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection