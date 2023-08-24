<h2>Datos del Período</h2>
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
            <label for="nombre_periodo" class="form-label">Nombre del periodo:</label>
            <input type="text" name="nombre_periodo" id="nombre_periodo" class="form-control"
                value="{{isset($periodo->nombre_periodo)?$periodo->nombre_periodo:old('nombre_periodo')}}">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="fecha_inicio" class="form-label">Fecha de inicio del periodo:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                value="{{isset($periodo->fecha_inicio)?$periodo->fecha_inicio:old('fecha_inicio')}}">
        </div>
        <div class="col">
            <label for="fecha_final" class="form-label">Fecha de final del periodo:</label>
            <input type="date" name="fecha_final" id="fecha_final" class="form-control"
                value="{{isset($periodo->fecha_final)?$periodo->fecha_final:old('fecha_final')}}">
        </div>
    </div>
    <div class="mt-5 text-center">
        <button type="submit" class="btn btn-success">{{$modo}} datos</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>
</div>