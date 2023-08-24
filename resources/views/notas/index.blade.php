@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - NOTAS</h1>
    </div>
    <div class="container">
        @if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show my-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong><i class="fa-solid fa-circle-info"></i> {!!Session::get('mensaje')!!}</strong>
        </div>
        @endif
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-user fa-10x p-5"></i>
                        <h4 class="card-title">Individual</h4>
                        <p class="card-text">Actualizar las notas individualmente</p>
                        <div class="input-group m-auto w-75">
                            <span class="input-group-text">ID</span>
                            <input type="text" id="input_cedula" class="form-control">
                            {!! Form::select('periodo_id', $periodo, null, ['class' => 'form-select', 'id' =>
                            'input_periodo']) !!}
                            <button class="btn btn-primary" type="button" id="btn_buscar"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-users fa-10x p-5"></i>
                        <h4 class="card-title">Masivo</h4>
                        <p class="card-text">Actualizar las notas de todos los alumnos inscritos en una materia</p>
                        <div class="input-group m-auto w-75">
                            <span class="input-group-text">ID</span>
                            <button class="btn btn-primary" type="button" id="btn_buscar"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fa-solid fa-file-lines fa-10x p-5"></i>
                    <h4 class="card-title">Reporte de notas</h4>
                    <p class="card-text">Muestra las notas que ha aprobado un alumno en su carrera</p>
                    <div class="input-group m-auto w-75">
                        <form action="{{url('/notas/notas-aprobadas')}}" method="post">
                        <span class="input-group-text">ID</span>
                            <input type="text" id="input_cedula" class="form-control" name="cedula">
                            @csrf
                            {{method_field('POST')}}
                            <button class="btn btn-primary" type="submit" id="btn_buscar"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
const init = () => {
    document.querySelector("#btn_buscar").addEventListener("click", redirectToCreate, false)
}

const redirectToCreate = () => {
    const input_cedula = document.querySelector('#input_cedula').value;
    let input_periodo = document.querySelector('#input_periodo').value;
    //input_periodo = input_periodo.options[input_periodo.selectedIndex].text Si se quiere el texto del select en vez del value
    url = 'notas/create/' + input_cedula + '/' + input_periodo;
    window.location.href = url;
}
init()
</script>
@endsection