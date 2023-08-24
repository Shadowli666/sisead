@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </ul>
</div>
@endif
@if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show my-3" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong><i class="fa-solid fa-circle-info"></i> {!!Session::get('mensaje')!!}</strong>
        </div>
@endif
<div class="row my-5 p-3 g-2">
    <div class="col">
        <h3 class="fs-4">Nombre del Alumno:</h3>
        <p class=>{{$estudiante->primer_nombre ." ". $estudiante->segundo_nombre." ". $estudiante->primer_apellido." ".$estudiante->segundo_apellido}}</p></div>
    <div class="col">
        <h3 class="fs-4">Carrera: </h3>
        <p> {{$estudiante->carrera->nombre_carrera}}</p>
    </div>
    <div class="col">
        <h3 class="fs-4">Periodo:</h3>
        {!! Form::select('periodo_id', $periodo, null, ['class' => 'form-select']) !!}
        <div class="mb-3">
            <label class="visually-hidden" for="estudiante_id">ID del Estudiante</label>
            <input type="hidden" class="form-control" name="estudiante_id" id="estudiante_id" value="{{$estudiante->id}}">
        </div>
    </div>
</div>
<hr>
<h2>Lista de Materias</h2>
<div class="row g-2">
    <div class="col-6" id="">
        @foreach($materias as $materia)
        <div class="checkbox" class="form-check-label">
            <label>
                {!! Form::checkbox('materias[]', $materia->id, null, ['class' => 'form-check-input']) !!}
                {{$materia->nombre_materia}}
            </label>
        </div>
        @endforeach
    </div>
    <div class="mt-5 text-center">
        <button type="submit" class="btn btn-success">{{$modo}} datos</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>
</div>