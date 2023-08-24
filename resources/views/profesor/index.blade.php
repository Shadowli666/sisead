@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - LISTA DE PROFESORES</h1>
    </div>
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
                    <th scope="col">Cedula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col>">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profesor as $dato)
                <tr class="">
                    <td>{{$dato->id}}</td>
                    <td>{{$dato->cedula}}</td>
                    <td>{{$dato->nombres}}</td>
                    <td>{{$dato->apellidos}}</td>
                    <td>{{$dato->correo}}</td>
                    <td>{{$dato->telefono}}</td>
                    <td class='d-flex'>
                        <a href="{{url('/profesor/'.$dato->id).'/edit'}}" class="btn btn-warning"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{url('/profesor/'.$dato->id)}}" method="post">
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
        {!! $profesor->links()!!}
    </div>
</div>
<script src="{{asset('js/colorModeToggler.js')}}"></script>
@endsection