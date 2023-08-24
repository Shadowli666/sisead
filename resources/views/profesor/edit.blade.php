@extends('layouts.app')
@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif
@section('content')
    <div class="container-fluid min-vh-100">
        <div class="text-center">
            <h1>SISEAD - EDICIÓN DE PROFESORES</h1>
        </div>
        <form action="{{url('/profesor/'.$profesor->id)}}" method="post" class="form-container container my-5">
            @csrf
            {{method_field('PATCH')}}
            @include('profesor.form',['modo'=>"Editar"])
        </form>
    </div>
@endsection