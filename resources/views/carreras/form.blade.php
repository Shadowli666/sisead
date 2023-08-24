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
<div class="row">
    <div class="col">
        <div class="mb-3">
            <label for="nombre_carrera" class="form-label">Nombre de la carrera:</label>
            <input type="text" name="nombre_carrera" id="nombre_carrera" class="form-control"
                value="{{isset($carreras->nombre_carrera)?$carreras->nombre_carrera:old('nombre_carrera')}}">
        </div>
    </div>
    <div class="col">
        <div class="mb-3">
            <label for="nombre_carrera" class="form-label">Siglas de la carrera:</label>
            <input type="text" name="sigla" id="sigla" class="form-control"
                value="{{isset($carreras->sigla)?$carreras->sigla:old('sigla')}}">
        </div>
    </div>
    <div class="mt-5 text-center">
        <button type="submit" class="btn btn-success">{{$modo}} datos</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>
</div>