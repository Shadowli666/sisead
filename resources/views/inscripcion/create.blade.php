@extends('layouts.app')
@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - MÓDULO DE ESTUDIANTES - INSCRIPCIÓN</h1>
    </div>
    <div class="container">
        <div class="form-container container my-5">
            <form method="POST" action="{{url('/inscripcion')}}">
                @csrf
                @include('inscripcion.form',['modo'=>'Almacenar'])
            </form>
        </div>
    </div>
</div>
@endsection