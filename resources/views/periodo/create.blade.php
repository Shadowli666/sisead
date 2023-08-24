@extends('layouts.app')
@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif
@section('content')
    <div class="container-fluid min-vh-100">
        <div class="text-center">
            <h1>SISEAD - REGISTRO DE PERIODO</h1>
        </div>
        <div class="form-container container my-5">
            <form method="POST" action="{{url('/periodo')}}">
                @csrf
                @include('periodo.form',['modo'=>'Almacenar'])
            </form>
        </div>
    </div>
    <script src="colorModeToggler.js"></script>
@endsection