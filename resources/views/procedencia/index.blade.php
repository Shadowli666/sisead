@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - LISTA DE PROCEDENCIAS</h1>
    </div>
    <a name="createBtn" id="createBtn" class="btn btn-success" href="{{url('procedencia/create')}}" role="button">Crear procedencia</a>

    <div class="table-responsive mt-5 p-3">
        @if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong><i class="fa-solid fa-circle-info"></i>  {{Session::get('mensaje')}}</strong>
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col>">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($procedencia as $dato)
                <tr class="">
                    <td>{{$dato->id}}</td>
                    <td>{{$dato->nombre_procedencia}}</td>
                    <td>
                        <a href="{{url('/procedencia/'.$dato->id).'/edit'}}" class="btn btn-warning"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{url('/procedencia/'.$dato->id)}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <!-- <input type="submit" value="Borrar" class="btn btn-danger" onclick="return confirm('¿Esta seguro?')"> -->
                            <button class="btn btn-danger" type="submit" onclick="return confirm('¿Esta seguro?')"><i
                                    class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection