<h2>Datos de la Carrera</h2>
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
<div class="row g-3 my-3">
    <div class="col">
        <label for="nombre">Nombre de la materia:</label>
        <input type="text" name="nombre_materia" id="nombre_materia" class="form-control"
        value="{{isset($materias->nombre_materia)?$materias->nombre_materia:old('nombre_materia')}}">
    </div>
    <div class="col">
        <label for="nombre">Codigo de la materia:</label>
        <input type="text" name="cod_materia" id="cod_materia" class="form-control"
        value="{{isset($materias->cod_materia)?$materias->cod_materia:old('cod_materia')}}">
    </div>
    <div class="col">
        <label for="carrera_id">Carrera:</label>
        {{Form::select('carrera_id', $carreras, $materias->carrera_id,['class'=>'form-select'])}}
    </div>
</div>
<div class="row g-3 my-3">
    <div class="col">
        <label for="costo_uc">Costo de UC:</label>
        <input type="number" name="costo_uc" id="costo_uc" class="form-control"
        value="{{isset($materias->costo_uc)?$materias->costo_uc:old('costo_uc')}}">
    </div>
    <div class="col">
        <label for="num_trimestre">Trimestre:</label>
        <input type="number" name="num_trimestre" id="num_trimestre" class="form-control" min="1" max="12"
        value="{{isset($materias->num_trimestre)?$materias->num_trimestre:old('num_trimestre')}}">
    </div>
</div>
    
    <div class="mt-5 text-center">
        <button type="submit" class="btn btn-success">{{$modo}} datos</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>