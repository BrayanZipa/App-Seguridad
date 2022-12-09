<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        html{
            margin: 0.5cm 0.5cm;
            font-size: 12px;
        }

        body{
            margin: 2cm 0cm 0.1cm;
        }

        header{
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
            line-height: 30px;
        }

        th.titulos-encabezado{
            width: 20%;
            text-align: center;
        }

        .tabla-encabezado{
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%
        }

        td, th {
        border: black 1px solid;
        }

        div.imagenes, h2{
            margin-top: 10px;
        }

        img{
            height: 40px;
            margin-top: 10px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    @inject('carbon', 'Carbon\Carbon')

    <header>
        <table class="tabla-encabezado">
            <thead>
                <tr>
                    <th class="titulos-encabezado">
                        <div class="imagenes">
                            <img src="{{ public_path('assets/imagenes/aviomar.png') }}" alt="Logo Aviomar">
                            <img src="{{ public_path('assets/imagenes/snider.png') }}" alt="Logo Snider">
                            <img src="{{ public_path('assets/imagenes/colvan.png') }}" alt="Logo Colvan">
                        </div>
                    </th>
                    <th>
                        <h2>{{ $titulo }}</h2>
                    </th>
                    <th class="titulos-encabezado">
                        <span>{{ $carbon::now()->format('d-m-Y') }}</span><br>
                        <span>{{ $carbon::now()->format('h:i:s A')}}</span>
                    </th>
                </tr>
            </thead>
        </table>
    </header>
    
    <main>
        <table class="tabla-encabezado">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo de persona</th>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    @if($registrosCompletos)
                    <th>Empresa a la que visita/pertenece</th>
                    <th>Colaborador a cargo</th>
                    @elseif($esColaborador)
                        <th>Empresa a la que pertenece</th>
                    @else
                        <th>Empresa que visita</th>
                        <th>Colaborador a cargo</th>
                    @endif
                    <th>Fecha de ingreso</th>
                    <th>Hora de ingreso</th>
                    <th>Fecha de salida</th>
                    <th>Hora de salida</th>
                    @if($registrosCompletos || $esColOrVisi)
                        <th>Ingresa activo</th>
                    @endif
                    <th>Ingresa vehículo</th>
                    <th>Ciudad</th>
                    <th>Registrado por</th>  
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                    <tr>
                        <th>{{ $reporte->id_registros }}</th>
                        <td>{{ $reporte->tipopersona }}</td>
                        <td>{{ $reporte->nombre }} {{ $reporte->apellido }}</td>
                        <td>{{ $reporte->identificacion }}</td>
                        @if(($registrosCompletos && ($reporte->id_tipo_persona == 1 || $reporte->id_tipo_persona == 4)) || (!$registrosCompletos && !$esColaborador))
                            <td>{{ $reporte->empresavisitada }}</td>
                        @else
                            <td>{{ $reporte->empresa }}</td>
                        @endif
                        @if($registrosCompletos || !$esColaborador)
                            <td>{{ $reporte->colaborador }}</td>
                        @endif
                            <td>{{ $carbon::parse($reporte->ingreso_persona)->format('d-m-Y') }}</td>
                            <td>{{ $carbon::parse($reporte->ingreso_persona)->format('h:i a') }}</td>
                        @if($reporte->salida_persona != null)
                            <td>{{ $carbon::parse($reporte->salida_persona)->format('d-m-Y') }}</td>
                            <td>{{ $carbon::parse($reporte->salida_persona)->format('h:i a') }}</td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        @if($registrosCompletos || $esColOrVisi)
                            <td>{{ $reporte->codigo_activo }}</td> 
                        @endif
                        <td>{{ $reporte->identificador }}</td> 
                        <td>{{ $reporte->city }}</td> 
                        <td>{{ $reporte->name }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>