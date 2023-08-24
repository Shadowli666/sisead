@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - MÓDULO DE ESTUDIANTES - INSCRIPCIÓN DE MATERIAS</h1>
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
                        <i class="fa-solid fa-user-plus fa-10x p-5"></i>
                        <h4 class="card-title">Inscripción</h4>
                        <p class="card-text">Inscribir materias en un período a estudiantes</p>
                        <div class="input-group m-auto w-50">
                            <span class="input-group-text">ID</span>
                            <input type="text" id="input_cedula_inscribir" class="form-control">
                            <button class="btn btn-primary" type="button" id="btn_inscribir"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-user-pen fa-10x p-5"></i>
                        <h4 class="card-title">Modificación de datos</h4>
                        <p class="card-text">Modificar inscripción de materias de estudiantes en un período</p>
                        <div class="input-group m-auto w-75">
                            <span class="input-group-text">ID</span>
                            <input type="text" id="input_cedula" class="form-control">
                            {!! Form::select('periodo_id', $periodo, null, ['class' => 'form-select', 'id' => 'input_periodo']) !!}
                            <button class="btn btn-primary" type="button" id="btn_buscar"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body text-center">
                <i class="fa-solid fa-file-lines fa-10x p-5"></i>
                <h4 class="card-title">Impresión de Planilla</h4>
                <p class="card-text">Imprimir la planilla de inscripción de un estudiante</p>
                <div class="input-group m-auto w-50">
                    <form action="inscripcion/planilla" method="post" class="d-flex mx-auto">
                        @csrf
                        <div class="input-group">

                            <span class="input-group-text">ID</span>
                            <input type="text" id="input_cedula_imprimir" class="form-control" required name="cedula">
                            {!! Form::select('input_periodo_imprimir', $periodo, null, ['class' => 'form-select', 'id' => 'input_periodo_imprimir']) !!}
                            <button class="btn btn-primary" type="submit" id="btn_imprimir"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const init = () => {
    document.querySelector("#btn_buscar").addEventListener("click", redirectToModificar, false)
   // document.querySelector("#btn_imprimir").addEventListener("click", redirectToImprimir, false)
    document.querySelector("#btn_inscribir").addEventListener("click", redirectToInscribir, false)
}

const redirectToModificar = () => {
    const input_cedula = document.querySelector('#input_cedula').value
    let input_periodo = document.querySelector('#input_periodo').value
    if(input_cedula == "" || input_periodo == ""){
        console.log("asdas");
    }
    else{
        //input_periodo = input_periodo.options[input_periodo.selectedIndex].text Si se quiere el texto del select en vez del value
        url = 'inscripcion/' + input_cedula +'/'+ input_periodo +'/edit'
        window.location.href = url;
    }
}
const redirectToInscribir = () => {
    const input_cedula_inscribir = document.querySelector('#input_cedula_inscribir').value
    url = 'inscripcion/create/' + input_cedula_inscribir
    window.location.href = url;
}
init()
</script>
@endsection