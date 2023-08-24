@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - ASIGNACIÓN DE MATERIAS</h1>
    </div>
    <div class="table-responsive mt-5 p-3">
        @if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong><i class="fa-solid fa-circle-info"></i> {{Session::get('mensaje')}}</strong>
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Profesor asignado</th>
                    <th scope="col">Asignar profesor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materias as $dato)
                <tr class="">
                    <td>{{$dato->nombre_materia}}</td>
                    <td>{{$dato->profesor?->nombres}}</td>
                    <form action="{{ route('profesor.storeSubject', $dato->id) }}}" method="post">
                        <td class='d-flex'>
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{$dato->id}}" name="id">
                            {{Form::select('profesor_id', $profesor,$dato->profesor_id,['class'=>'form-select'])}}
                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-check"></i></button>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('js/colorModeToggler.js')}}"></script>
@endsection