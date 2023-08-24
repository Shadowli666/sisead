@extends('layouts.app')
@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif
@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - MÓDULO DE ESTUDIANTES - PRE INSCRIPCIÓN</h1>
    </div>
    <div class="container">
        <div class="form-container container my-5">
            <form method="POST" action="{{url('/estudiante')}}">
                @csrf
                @include('estudiante.form',['modo'=>'Almacenar'])
            </form>
        </div>
    </div>
</div>
@endsection