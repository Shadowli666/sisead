<h2>Datos de la Procedencia</h2>
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
            <label for="nombre_procedencia" class="form-label">Nombre del procedencia:</label>
            <input type="text" name="nombre_procedencia" id="nombre_procedencia" class="form-control"
                value="{{isset($procedencia->nombre_procedencia)?$procedencia->nombre_procedencia:old('nombre_procedencia')}}">
        </div>
    </div>
    <div class="mt-5 text-center">
        <button type="submit" class="btn btn-success">{{$modo}} datos</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>
</div>