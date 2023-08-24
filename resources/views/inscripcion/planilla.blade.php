<!doctype html>
<html lang="en">

<head>
    <title>Planilla de Preinscripción</title>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
    tr>td>p {
        margin: 0;
    }

    input[type="checkbox"] {
        display: inline;
    }

    table,
    th,
    td {
        border-collapse: collapse;
        border: 1px solid black;
        height: 25px;
    }

    th {
        background-color: #c7c7c7;
    }

    .underline {
        text-decoration: underline;
    }

    body {
        font-family: "Arial";
    }

    .row {
        height: 60px;
    }

    .leyenda {
        font-size: 10px;
    }

    .borderless {
        border: none;
        padding: 6px;
    }

    .table-materias {
        width: 100%;
        table-layout: fixed;
        text-align: center;
    }

    .footer {
        position: fixed;
        bottom: 0;
    }

    .footer>table {
        margin-bottom: 10px;
    }

    .text-center {
        text-align: center;
    }
    </style>
</head>

<img src="{{public_path('img/logo.png') }}" alt="Logo Uniojeda"
    style="width: 80px; position: absolute; margin-top: 20px;">

<body>
    <div style="text-align: center;">
        <p><strong>UNIVERSIDAD ALONSO DE OJEDA</strong></p>
        <p>FACULTAD DE INGENIER&Iacute;A</p>
        <p>ESTUDIOS A DISTANCIA</p>
        <p>PLANILLA DE AUTORIZACI&Oacute;N PARA INSCRIPCIONES</p>
    </div>
    <div style="width: 100%;">
        <p style="display: inline-block;">
            ND:____________________________
            Fecha: <span class="underline">{!!date('d');!!}/{!!date('m');!!}/{!!date('Y');!!}</span>
            Per&iacute;odo: <span class="underline">{!!$data[0]->periodo->nombre_periodo!!}</span>
        </p>
    </div>
    <table style="width: 100%; table-layout: fixed;">
        <thead>
            <tr>
                <th colspan="3">&nbsp;<strong>DATOS DEL ESTUDIANTE</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="borderless">Apellidos:
                    {!!$data[0]->estudiante->primer_apellido!!}
                    {!!$data[0]->estudiante->segundo_apellido!!}
                </td>
                <td class="borderless">Nombres: {!!$data[0]->estudiante->primer_nombre!!}
                    {!!$data[0]->estudiante->segundo_nombre!!}</td>
                <td class="borderless">CI: {!!number_format($data[0]->estudiante->cedula, 0, ',', '.');!!}</td>
            <tr>
            <tr>
                <td class="borderless">Correo: {!!$data[0]->estudiante->correo!!}</td>
                <td class="borderless">Tel&eacute;fono: {!!$data[0]->estudiante->telefono1!!} </td>
                <td class="borderless">UCA: {{$ucInscritas->total_uc}}</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="3" style="text-align: center;"><strong>CARRERA</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="borderless" colspan="3">
                    <p>
                        @foreach ($carreras as $carrera)
                        @if($carrera->nombre_carrera == $data[0]->estudiante->carrera->nombre_carrera)
                        <span>{!!$data[0]->estudiante->carrera->nombre_carrera!!} <input type="checkbox" checked></span>
                        @else
                        <span>{{$carrera->nombre_carrera}} <input type="checkbox"></span>
                        @endif
                        @endforeach
                    </p>
                </td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="3" style="text-align: center;"><strong>PAGO PROCEDENTE</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="borderless" colspan="3">
                    <p>
                        @foreach ($procedencias as $procedencia)
                        @if ($procedencia->nombre_procedencia == $data[0]->estudiante->procedencia->nombre_procedencia)
                        <span>{!!$data[0]->estudiante->procedencia->nombre_procedencia!!} <input type="checkbox"
                                checked></span>
                        @else
                        <span>{{$procedencia->nombre_procedencia}} <input type="checkbox"></span></span>
                        @endif
                        @endforeach

                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-materias">
        <thead>
            <tr>
                <th style="width: 35%;">UNIDAD CURRICULAR</th>
                <th style="width: 15%;">SECCI&Oacute;N</th>
                <th>CA</th>
                <th>RA</th>
                <th>AC</th>
                <th>CS</th>
                <th>AP</th>
                <th>CH</th>
                <th>EU</th>
                <th>CC</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $inscripcion)
            <tr>
                <td class="row">{{$inscripcion->materias->nombre_materia}}</td>
                <td class="row">
                    {{$inscripcion->materias->carreras->sigla}}{{str_pad($inscripcion->materias->num_trimestre, 2, '0', STR_PAD_LEFT)}}35
                </td>
                <td class="row">X</td>
                <td class="row"></td>
                <td class="row"></td>
                <td class="row"></td>
                <td class="row"></td>
                <td class="row"></td>
                <td class="row"></td>
                <td class="row"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <div class="footer">
        <table style="width: 100%; text-align:center;border:none;">
            <tbody>
                <tr>
                    <td style="border:none;">_____________________________________</td>
                    <td style="border:none;">_____________________________________</td>
                </tr>
                <tr>
                    <td style="border:none;">FIRMA DEL ESTUDIANTE</td>
                    <td style="border:none;">FIRMA Y SELLO DEL DECANATO</td>
                </tr>
            </tbody>
        </table>

        <p class="leyenda">Leyenda: ND Numero de control de Documento CI Numero de Cédula de Identidad / UCA Unidades de
            Crédito
            Aprobadas /CA Cursar Asignatura / RA Retirar</p>
        <p class="leyenda">Asignatura / AC Apertura de Cupo / CS Cambio de Sección / AP Aprobar Paralelo / CH Choque de
            Horas /
            EU Exceso UC / CC Cambio de Carrera</p>
    </div>
</body>

</html>