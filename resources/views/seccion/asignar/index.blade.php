@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - ASIGNACION DE MATERIAS A SECCIONES</h1>
    </div>

    <div class="container mt-4">
        <form action="">
                <div class="row">
                <div class="col-3">
                    <label for="periodo_id">Periodo: </label>
                    <select name="periodo_id" id="periodo_id" class="form-select">
                        <option selected>Seleccione un periodo</option>
                        @foreach($lista_periodos as $periodo)
                            <option value="{{$periodo->id}}">{{$periodo->nombre_periodo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="carrera_id">Carrera: </label>
                    <select name="carrera_id" id="carrera_id" class="form-select">
                        <option selected>Seleccione un periodo</option>
                        @foreach($lista_carreras as $carrera)
                            <option value="{{$carrera->id}}">{{$carrera->nombre_carrera}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="seccion_id">Sección: </label>
                    <select name="seccion_id" id="seccion_id" class="form-select" disabled>
                        <option selected>Seleccione una seccion</option>
                    </select>
                </div>
                <div class="col-3">
                    <button type="reset" class="btn btn-primary">Limpiar</button>
                </div>
            </div>
            </form>
    </div>
</div>
@push('script-seccion-materia')
<script>
    const init = () =>{
        document.querySelector('#periodo_id').addEventListener('change',evalChange,false)
        document.querySelector('#carrera_id').addEventListener('change',evalChange,false)
    }
    const readPeriodo = () =>{
        return document.querySelector('#periodo_id').value
    }
    const readCarrera = () =>{
        return document.querySelector('#carrera_id').value
    }
    const evalChange = (e) =>{
        const selectSectionElement = document.querySelector('#seccion_id')
        //Cambiar el select periodo a disabled
        if(e.target.id == "periodo_id"){
            e.target.setAttribute('disabled','')
        }
        //Cargar datos en el select de Seccion
        if(readCarrera() > 0 && readPeriodo() >0)
        {
            //remover el disabled al tener una seccion y un periodo seleccionados
            selectSectionElement.removeAttribute('disabled');
            //AJAX
            $.get('../api/seccion/carrera/'+ readCarrera(), function(data){
                var html_select = '<option value="">Seleccione una seccion</option>';
                data.forEach(element => {
                    html_select += '<option value="'+element.id+'">'+element.codigo_seccion+'</option>'
                });
                //selectSectionElement.innerHTML= html_select
                $('#seccion_id').html(html_select);
            });
            //TODO añadir el cargado de materias automaticos, a traves de un modal que añada todo de una. boton de eliminar materia a través de api
        }else{
            //añadir el disabled al tener una seccion y un periodo seleccionados
            selectSectionElement.setAttribute('disabled','');
        } 
    }
    init();
    
</script>
@endpush
@endsection