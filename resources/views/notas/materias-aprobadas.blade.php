@extends('layouts.app')
@section('content')
<style>
#logo {
    width: 80px;
    position: absolute;
    margin-top: 20px;
}

input[type="checkbox"] {
    display: inline;
}

table,
th,
td {
    border-collapse: collapse;
    height: 25px;
}

.underline {
    text-decoration: underline;
}

body {
    font-family: "Arial";
}

.text-center {
    text-align: center;
}
</style>
<div class="container-fluid min-vh-100">
    <div class="text-center">
        <h1>SISEAD - NOTAS</h1>
    </div>
    <div class="container">
        <body>
            <table style="width: 100%; table-layout: fixed; margin-top: 10px; margin-bottom: 25px;">
                <tbody>
                    <tr>
                        <td>Estudiante:
                            {!!$estudiante->primer_nombre!!}
                            {!!$estudiante->primer_apellido!!}
                            {!!$estudiante->segundo_nombre!!}
                            {!!$estudiante->segundo_apellido!!}
                        </td>
                        <td>Cédula de Identidad: {!!number_format($estudiante->cedula, 0, ',', '.');!!}</td>
                        <td>Carrera: {{$estudiante->carrera->nombre_carrera}}</td>
                    <tr>
                </tbody>
            </table>

            <table style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th style="width: 8%;">CODIGO</th>
                        <th style="width: 20%;">ASIGNATURAS</th>
                        <th style="width: 6%;">LAPSO</th>
                        <th style="width: 12%;">ACADEMICO PERIODO</th>
                        <th style="width: 5%;">UC</th>
                        <th style="width: 5%;">Nº</th>
                        <th style="width: 5%;" class="text-center">LETRAS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notasAprobadas as $notaAprobada)
                    <tr>
                        <td>{{$notaAprobada->inscripcion_estudiantes->materias->cod_materia}}</td>
                        <td>{{$notaAprobada->inscripcion_estudiantes->materias->nombre_materia}}</td>
                        <td>{{$notaAprobada->inscripcion_estudiantes->materias->num_trimestre}}</td>
                        <td>{{$notaAprobada->inscripcion_estudiantes->periodo->nombre_periodo}}</td>
                        <td>{{$notaAprobada->inscripcion_estudiantes->materias->costo_uc}}</td>
                        <td>{{$notaAprobada->nota_definitiva}}</td>
                        <td>{{strtoupper($NumerosALetras->format($notaAprobada->nota_definitiva));}}</td>
                    </tr>
                    @endforeach
                    <tr></tr>
                </tbody>
            </table>
            <div class="mt-4">
                <a class="btn btn-primary" href="{{url('notas/planilla/notas-aprobadas/'.$estudiante->cedula)}}"
                    role="button">Exportar <i class="fa-solid fa-file-pdf fa-2xl"></i></a>
            </div>
        </body>

        </html>
    </div>
</div>
@endsection