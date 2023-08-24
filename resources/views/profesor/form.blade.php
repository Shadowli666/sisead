<h2>Datos del Profesor</h2>

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
        <label for="cedula" class="form-label">Cédula:</label>
        <div class="mb-3 input-group">
            <input type="number" name="cedula" id="cedula" class="form-control"
                value="{{isset($profesor->cedula)?$profesor->cedula:old('cedula')}}">
        </div>
    </div>
    <div class="col">
        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres:</label>
            <input type="text" name="nombres" id="nombres" class="form-control"
                value="{{isset($profesor->nombres)?$profesor->nombres:old('nombres')}}">
        </div>
    </div>
    <div class="col">
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control"
                value="{{isset($profesor->apellidos)?$profesor->apellidos:old('apellidos')}}">
        </div>
    </div>
</div>
<h2>Datos de Contacto:</h2>
<div class="row my-3">
    <div class="col">
        <label for="correo" class="form-label">Correo electrónico:</label>
        <input type="email" name="correo" id="correo" class="form-control"
            value="{{isset($profesor->correo)?$profesor->correo:old('correo')}}">
    </div>
    <div class="col">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="tel" name="telefono" id="telefono" class="form-control"
            value="{{isset($profesor->telefono)?$profesor->telefono:old('telefono')}}">
    </div>
</div>
<div class="mt-5 text-center">
    <button type="submit" class="btn btn-success">{{$modo}} datos</button>
    <button type="reset" class="btn btn-secondary">Limpiar</button>
</div>