@extends('layouts.app')
@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif
@section('content')
    <div class="container-fluid min-vh-100">
        <div class="text-center">
            <h1>SISEAD - REGISTRO DE PROCEDENCIA</h1>
        </div>
        <div class="form-container container my-5">
        <form action="{{url('/procedencia/'.$procedencia->id)}}" method="post" class="form-container container my-5">
                @csrf
                {{method_field('PATCH')}}
                @include('procedencia.form',['modo'=>'Editar'])
            </form>
        </div>
    </div>
    <script src="colorModeToggler.js"></script>
@endsection