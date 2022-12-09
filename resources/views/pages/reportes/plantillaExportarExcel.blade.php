@inject('carbon', 'Carbon\Carbon')

<table>
    <thead>
        <tr>
            <th><strong>ID</strong></th>
            <th><strong>Tipo de persona</strong></th>
            <th><strong>Nombre</strong></th>
            <th><strong>Identificación</strong></th>
            @if($registrosCompletos)
                <th><strong>Empresa a la que visita/pertenece</strong></th>
                <th><strong>Colaborador a cargo</strong></th>
            @elseif($esColaborador)
                <th><strong>Empresa a la que pertenece</strong></th>
            @else
                <th><strong>Empresa que visita</strong></th>
                <th><strong>Colaborador a cargo</strong></th>
            @endif
            <th><strong>Fecha de ingreso</strong></th>
            <th><strong>Hora de ingreso</strong></th>
            <th><strong>Fecha de salida</strong></th>
            <th><strong>Hora de salida</strong></th>
            @if($registrosCompletos || $esColOrVisi)
                <th><strong>Ingresa activo</strong></th>
            @endif
            <th><strong>Ingresa vehículo</strong></th>
            <th><strong>Ciudad</strong></th>
            <th><strong>Registrado por</strong></th>  
            <th><strong>Descripción</strong></th> 
        </tr>
    </thead>
    <tbody>
    @foreach($reportes as $reporte)
        <tr>
            <td>{{ $reporte->id_registros }}</td>
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
            <td>{{ $reporte->descripcion }}</td> 
        </tr>
    @endforeach
    </tbody>
</table>