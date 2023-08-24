@extends('layouts.app')
@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif
@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - MÓDULO DE ESTUDIANTES - INSCRIPCIÓN</h1>
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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Código de Materia</th>
                        <th scope="col">Nombre de materia</th>
                        <th scope="col">Costo de UC</th>
                        <th scope="col">Número de Trimestre</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materias_inscritas as $materia_inscrita)
                    <tr class="">
                        <td>
                            {{$materia_inscrita->materias->cod_materia}}
                        </td>
                        <td>
                            {{$materia_inscrita->materias->nombre_materia}}
                        </td>
                        <td>
                            {{$materia_inscrita->materias->costo_uc}}
                        </td>
                        <td>
                            {{$materia_inscrita->materias->num_trimestre}}
                        </td>
                        <td>
                            {{$materia_inscrita->materias->profesor?->nombres}}
                        </td>
                        <td class='d-flex'>
                            <form action="{{url('inscripcion/'.$materia_inscrita->id)}}" method="post">
                                @csrf
                                {{method_field('DELETE')}}
                                <!-- <input type="submit" value="Borrar" class="btn btn-danger" onclick="return confirm('¿Esta seguro?')"> -->
                                <button class="btn btn-danger" type="submit"
                                    onclick="return confirm('¿Esta seguro?')"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5 text-center">
                <a class="btn btn-success" href="{{url('inscripcion/planilla/'.$estudiante->cedula.'/'.$periodo->id)}}" role="button">Imprimir planilla</a>
                <button disabled type="reset" class="btn btn-secondary">Imprimir horario</button>
            </div>
        </div>
    </div>
</div>
@endsection