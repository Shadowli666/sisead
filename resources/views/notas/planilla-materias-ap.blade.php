<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    html{
        padding: 0;
        margin: 30px;
    }
    body { 
        font-family: "Arial";
    }

    #logo {
        width: 80px;
        position: absolute;
        margin-top: 20px;
    }

    #header {
        font-size: 16px;
    }

    table,td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .underline {
        text-decoration: underline;
    }

    .borderless {
        border: none;
    }

    .text-center {
        text-align: center;
    }
    .table-notas{
        font-size: 14px;
    }
    </style>
    <title>Document</title>
</head>

<body>
    <img src="{{public_path('img/logo.png')}}" alt="Logo Uniojeda" id="logo">

    <body>
        <div style="text-align: center;" id="header">
            <p><strong>UNIVERSIDAD ALONSO DE OJEDA</strong></p>
            <p>FACULTAD DE INGENIER&Iacute;A</p>
            <p>ESTUDIOS A DISTANCIA</p>
            <p>REGISTRO DE MATERIAS APROBADAS DEL ESTUDIANTE</p>
        </div>
        <div style="width: 100%;">
            <p style="display: inline-block;">
                Fecha: <span class="underline">{!!date('d');!!}/{!!date('m');!!}/{!!date('Y');!!}</span>
            </p>
        </div>
        <table style="width: 100%; table-layout: fixed;" class="borderless">
            <tr>
                <td class="borderless">Estudiante:
                    {!!$estudiante->primer_nombre!!}
                    {!!$estudiante->primer_apellido!!}
                    {!!$estudiante->segundo_nombre!!}
                    {!!$estudiante->segundo_apellido!!}
                    <td class="borderless">Carrera: {{$estudiante->carrera->nombre_carrera}}</td>
                </td>
            </tr>
            <tr>
                <td class="borderless">Cédula de Identidad: {!!number_format($estudiante->cedula, 0, ',', '.');!!}</td>
            </tr>
        </table>
        <br>
        <table style="table-layout: fixed; width: 100%;" class="table-notas borderless">
            <thead>
                <tr>
                    <td style="width: 10%;" class="borderless"></td>
                    <td style="width: 40%;" class="borderless"></td>
                    <td style="width: 10%;" class="borderless"></td>
                    <td style="width: 15%;">PERIODO</td>
                    <td style="width: 5%;" class="borderless"></td>
                    <td colspan ="2" style="width: 5%;" class="text-center">CALIFICACIÓN</td>
                </tr>
            </thead>
        </table>
        <table style="table-layout: fixed; width: 100%;" class="table-notas">
            <thead>
                <tr>
                    <td style="width: 10%;">CODIGO</td>
                    <td style="width: 40%;">ASIGNATURAS</td>
                    <td style="width: 10%;">LAPSO</td>
                    <td style="width: 15%;">ACADEMICO</td>
                    <td style="width: 5%;">UC</td>
                    <td style="width: 5%;">Nº</td>
                    <td>LETRAS</td>
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
                    <td>{{round($notaAprobada->nota_definitiva)}}</td>
                    <td>{{strtoupper($NumerosALetras->format(round($notaAprobada->nota_definitiva)));}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>