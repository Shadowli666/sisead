@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modificación de parámetros</h1>
    <div class="card-group my-3">
        <div class="card">
            <div class="text-center bg-primary bg-gradient" style="--bs-bg-opacity: .8;">
                <i class="fa-solid fa-calendar fa-10x p-5 text-blue "></i>
            </div>
            <div class="card-body">
                <h2 class="card-title">Períodos</h2>
                <p class="card-text">Añadir y eliminar Lapsos Académicos</p>
                <a href="{{url('periodo/')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-right-long fa-2x"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="text-center bg-info bg-gradient" style="--bs-bg-opacity: .8;">
                <i class="fa-solid fa-users fa-10x p-5 text-blue"></i>
            </div>
            <div class="card-body">
                <h2 class="card-title">Procedencia</h2>
                <p class="card-text">Añadir y eliminar procedencias de los estudiantes inscritos</p>
                <a href="{{url('procedencia/')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-right-long fa-2x"></i></a>
            </div>
        </div>
    </div>
    <div class="card-group my-3">
        <div class="card">
            <div class="text-center bg-danger bg-gradient" style="--bs-bg-opacity: .8;">
                <i class="fa-solid fa-school fa-10x p-5 text-blue"></i>
            </div>
            <div class="card-body">
                <h2 class="card-title">Carreras</h2>
                <p class="card-text">Añadir y eliminar carreras de la Facultad</p>
                <a href="{{url('carreras/')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-right-long fa-2x"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="text-center bg-success bg-gradient" style="--bs-bg-opacity: .8;">
                <i class="fa-solid fa-book-open fa-10x p-5 text-blue"></i>
            </div>
            <div class="card-body">
                <h2 class="card-title">Materias</h2>
                <p class="card-text">Añadir y eliminar Materias de las carreras</p>
                <a href="{{url('materias/')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-right-long fa-2x"></i></a>
            </div>
        </div>
    </div>
    <div class="card-group my-3">
        <div class="card">
            <div class="text-center bg-info bg-gradient" style="--bs-bg-opacity: .8;">
                <i class="fa-solid fa-puzzle-piece fa-10x p-5 text-blue"></i>
            </div>
            <div class="card-body">
                <h2 class="card-title">Secciones</h2>
                <p class="card-text">Crear, editar y eliminar secciones</p>
                <a href="{{url('seccion/')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-right-long fa-2x"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection