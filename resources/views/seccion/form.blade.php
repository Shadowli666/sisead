<h2>Datos de Sección</h2>

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
            <label for="carrera_id" class="form-label">Carrera:</label>
            {{Form::select('carrera_id', $carreras, $seccion->carrera_id,['class'=>'form-select'])}}
        </div>
    </div>
    <div class="col">
        <label for="cedula" class="form-label">Número de Trimestre:</label>
        <div class="mb-3 input-group">
            <select name="num_trimestre" id="num_trimestre" class="form-select"">
            @foreach (range(1, 12) as $num_trimestre)
    @if ($num_trimestre == (isset($seccion->num_trimestre) ? $seccion->num_trimestre : old('num_trimestre')))
        <option value=" {{ $num_trimestre }}" selected>{{ $num_trimestre }}</option>
                @else
                <option value="{{ $num_trimestre }}">{{ $num_trimestre }}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col">
        <div class="mb-3">
            <label for="codigo_seccion" class="form-label">Nombre de la seccion:</label>
            <input type="text" name="codigo_seccion" id="codigo_seccion" class="form-control"
                value="{{isset($seccion->codigo_seccion)?$seccion->codigo_seccion:old('codigo_seccion')}}">
        </div>
    </div>
    <div class="mt-5 text-center">
        <button type="submit" class="btn btn-success">{{$modo}} datos</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>