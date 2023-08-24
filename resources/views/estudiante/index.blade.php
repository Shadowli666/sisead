@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - MÓDULO DE ESTUDIANTES - PRE INSCRIPCIÓN</h1>
    </div>
    @if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong><i class="fa-solid fa-circle-info"></i>  {{Session::get('mensaje')}}</strong>
        </div>
    @endif
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <a href="{{url('estudiante/create')}}">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-user-plus fa-10x p-5"></i>
                            <h4 class="card-title">Pre-Inscripción</h4>
                            <p class="card-text">Adicionar estudiantes nuevos al sistema</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-user-pen fa-10x p-5"></i>
                        <h4 class="card-title">Modificación de datos</h4>
                        <p class="card-text">Modificar datos de estudiantes ya inscritos en el sistema</p>
                        <div class="input-group m-auto w-50">
                            <span class="input-group-text">ID</span>
                            <input type="text" id="input_cedula" class="form-control">
                            <button class="btn btn-primary" type="button" id="btn_buscar"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const init = () => {
    document.querySelector("#btn_buscar").addEventListener("click", redirectTo, false)
}

const redirectTo = () => {
    const input_cedula = document.querySelector('#input_cedula').value
    url = 'estudiante/'+input_cedula+'/edit'
    window.location.href=url;
}
init()
</script>
@endsection