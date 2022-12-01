<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
// use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel;
use App\Exports\ReportesExport;
use App\Models\Persona;
use App\Models\Registro;
use Carbon\Carbon;

// use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    protected $usuarios;

    /**
     * Constructor que inicializa todos los modelos
     */
    public function __construct(User $usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $exitCode = Artisan::call('cache:clear');
        // $this->usuarios->asiganrRol(auth()->user());

        return view('pages.reportes.reportes');
        // return Excel::download(new UsersExport, 'users.xlsx');
        // return Excel::download(new RegistrosExport, 'registros.xlsx');
        // return (new RegistrosExport)->download('registros_visitantes_Noviembre.pdf', Excel::DOMPDF);

        // return (new ReportesExport)->download('Visitantes_Noviembre_Colvan.xlsx'); 
    }


    public function determinarTipoPersona($tipoPersona) 
    {
        if($tipoPersona == 1 || $tipoPersona == 4){
            $esColaborador = false;
            $esColOrVisi= false;
            if($tipoPersona == 1){
                $esColOrVisi = true;
            }
        } else if($tipoPersona == 2 || $tipoPersona == 3){
            $esColaborador = true;
            $esColOrVisi = false;
            if($tipoPersona == 3){
                $esColOrVisi = true;
            }
        }  

        return [$esColaborador, $esColOrVisi];
    }

    /**
     * 
     */
    public function exportarReportes(Request $request) 
    {
        $datos = $request->all();

        $this->validarFiltros($request);

        // $request->validate([
        //     'fecha' => 'required|date_format:d/m/Y'
        // ], [
        //     'fecha.required' => 'Se requiere que ingrese la fecha',
        //     'fecha.date_format' => 'La fecha debe tener un formato valido'
        // ]);

        // return 'paso';
        // return $datos;
        // if(isset($datos['tipoPersona'])){
        //     [$esColaborador, $esColOrVisi] = $this->determinarTipoPersona($datos['tipoPersona']);
        //     if($datos['tipoPersona'] == 1 || $datos['tipoPersona'] == 4){
        //         $esColaborador = false;
        //         $esColOrVisi= false;
        //         if($datos['tipoPersona'] == 1){
        //             $esColOrVisi = true;
        //         }
        //     } else if($datos['tipoPersona'] == 2 || $datos['tipoPersona'] == 3){
        //         $esColaborador = true;
        //         $esColOrVisi = false;
        //         if($datos['tipoPersona'] == 3){
        //             $esColOrVisi = true;
        //         }
        //     }    
        // }

        if($datos['formato'] == 'excel'){
            if($datos['tipoReporte'] == 1 || $datos['tipoReporte'] == 2){
                if(isset($datos['tipoPersona']) && $datos['tipoPersona'] != 5) {
                    [$esColaborador, $esColOrVisi] = $this->determinarTipoPersona($datos['tipoPersona']);
                }

                if(isset($datos['fecha'])){
                    $datos['fecha'] = Carbon::createFromFormat('d/m/Y', $datos['fecha'])->toDateString();
                }

                if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
                    if($datos['tipoReporte'] == 1){
                        return (new ReportesExport($this->reporteAgrupadoAnioMes($datos['anio'], $datos['mes'])->get(), true, false))->download('reportes1.xlsx');
                    } else {
                        return (new ReportesExport($this->reporteFechaEspecifica($datos['fecha'])->get(), true, false))->download('report1.xlsx');
                    }
                    
                } else if(isset($datos['tipoPersona']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas') && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
                    if($datos['tipoReporte'] == 1){
                        return (new ReportesExport($this->reporteAgrupadoTipoPersona($datos['anio'], $datos['mes'], $datos['tipoPersona'])->get(), false, $esColaborador, $esColOrVisi))->download('reportes2.xlsx');
                    } else {
                        return (new ReportesExport($this->reporteFechaEspecificaTipoPersona($datos['fecha'], $datos['tipoPersona'])->get(), false, $esColaborador, $esColOrVisi))->download('report2.xlsx');
                    }  
                        
                } else if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && isset($datos['ciudad'])){
                    if($datos['tipoReporte'] == 1){
                        return (new ReportesExport($this->reporteAgrupadoCiudad($datos['anio'], $datos['mes'], $datos['ciudad'])->get(), true, false))->download('reportes3.xlsx');
                    } else {
                        return (new ReportesExport($this->reporteFechaEspecificaCiudad($datos['fecha'], $datos['ciudad'])->get(), true, false))->download('report3.xlsx');
                    } 
                
                } else if((isset($datos['tipoPersona'])) && isset($datos['ciudad']) && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
                    if($datos['tipoReporte'] == 1){
                        return (new ReportesExport($this->reporteAgrupado_tipoPersona_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['ciudad'])->get(), false, $esColaborador, $esColOrVisi))->download('reportes4.xlsx');
                    } else {
                        return (new ReportesExport($this->reporteFechaEspecifica_tipoPersona_ciudad($datos['fecha'], $datos['tipoPersona'], $datos['ciudad'])->get(), false, $esColaborador, $esColOrVisi))->download('report4.xlsx');
                    } 

                } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
                    if($datos['tipoReporte'] == 1){
                        return (new ReportesExport($this->reporteAgrupado_visitantes_empresa($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'])->get(), false, $esColaborador, $esColOrVisi))->download('reportes5.xlsx');
                    } else {
                        return (new ReportesExport($this->reporteFechaEspecifica_visitantes_empresa($datos['fecha'], $datos['tipoPersona'], $datos['empresa'])->get(), false, $esColaborador, $esColOrVisi))->download('report5.xlsx');
                    } 
                    
                } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && isset($datos['ciudad'])){
                    if($datos['tipoReporte'] == 1){
                        return (new ReportesExport($this->reporteAgrupado_visitantes_empresa_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get(), false, $esColaborador, $esColOrVisi))->download('reportes6.xlsx');
                    } else {
                        return (new ReportesExport($this->reporteFechaEspecifica_visitantes_empresa_ciudad($datos['fecha'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get(), false, $esColaborador, $esColOrVisi))->download('report6.xlsx');
                    }  
                }
            } else {

                // $request->validate([
                //     'anio' => 'required|integer', 
                //     'mes' => 'required|integer', 
                //     'identificacion' => 'required|exists:se_personas,identificacion',
                // ], [
                //     'anio.required' => 'Se requiere que elija un año',
                //     'anio.integer' => 'El año debe ser de tipo entero',

                //     'mes.required' => 'Se requiere que eilija un mes',
                //     'mes.integer' => 'El mes debe ser de tipo entero',

                //     'identificacion.required' => 'Se requiere que ingrese el número de indentificación de la persona',
                //     'identificacion.exists' => 'La identificación ingresada no existe en el sistema',
                // ]);

                [$esColaborador, $esColOrVisi] = $this->determinarTipoPersona(Persona::where('identificacion', $datos['identificacion'])->first()->id_tipo_persona);

                return (new ReportesExport($this->reporteIndividualMes($datos['anio'], $datos['mes'], $datos['identificacion'])->get(), false, $esColaborador, $esColOrVisi))->download('reportIndividual.xlsx');

            }
        } 

        // $this->validarFiltros($request);

        // if($datos['tipoReporte'] == 1){
        //     if($datos['formato'] == 'excel'){
        //         if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
        //             return (new ReportesExport($this->reporteAgrupadoAnioMes($datos['anio'], $datos['mes'])->get(), true, false))->download('reportes1.xlsx');
        //             // return 'primer';
        //         } else if(isset($datos['tipoPersona']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas') && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
        //             return (new ReportesExport($this->reporteAgrupadoTipoPersona($datos['anio'], $datos['mes'], $datos['tipoPersona'])->get(), false, $esColaborador, $esColOrVisi))->download('reportes2.xlsx');
        //             // return 'segundo';
        //         } else if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && isset($datos['ciudad'])){
        //             return (new ReportesExport($this->reporteAgrupadoCiudad($datos['anio'], $datos['mes'], $datos['ciudad'])->get(), true, false))->download('reportes3.xlsx');
        //             // return 'tercer';
        //         } else if((isset($datos['tipoPersona'])) && isset($datos['ciudad']) && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
        //             return (new ReportesExport($this->reporteAgrupado_tipoPersona_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['ciudad'])->get(), false, $esColaborador, $esColOrVisi))->download('reportes4.xlsx');
        //             // return 'cuarto';
        //         } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
        //             return (new ReportesExport($this->reporteAgrupado_visitantes_empresa($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'])->get(), false, $esColaborador, $esColOrVisi))->download('reportes5.xlsx');
        //             // return 'quinto';
        //         } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && isset($datos['ciudad'])){
        //             return (new ReportesExport($this->reporteAgrupado_visitantes_empresa_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get(), false, $esColaborador, $esColOrVisi))->download('reportes6.xlsx');
        //             // return 'sexto';
        //         }
        //     }
        // } else if($datos['tipoReporte'] == 2){
        //     if($datos['formato'] == 'excel'){
        //         $datos['fecha'] = Carbon::createFromFormat('d/m/Y', $datos['fecha'])->toDateString();
        //         // return $datos;

        //         if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
        //             return (new ReportesExport($this->reporteFechaEspecifica($datos['fecha'])->get(), true, false))->download('report1.xlsx');

        //         } else if(isset($datos['tipoPersona']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas') && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
        //             return (new ReportesExport($this->reporteFechaEspecificaTipoPersona($datos['fecha'], $datos['tipoPersona'])->get(), false, $esColaborador, $esColOrVisi))->download('report2.xlsx');
        //         } 

        //     }
        // } else {
        //     if($datos['formato'] == 'excel'){
        //         return (new ReportesExport($this->reporteIndividualMes($datos['anio'], $datos['mes'], $datos['identificacion'])->get(), false, false))->download('reportIndividual.xlsx');
        //     }
        // }


        // return Excel::download(new UsersExport, 'users.xlsx');

        //consulta
        // $pdf = PDF::loadView('users.pdf', compact('consulta'));
        // return $pdf->download('user-list.pdf');
    }


    /**
     * Función que permite validar los datos enviados en los filtros de información de los diferentes tipos de reportes
     */
    public function validarFiltros(Request $request){
        $tipoReporte = $request->input('tipoReporte');

        $reglas = [
            'anio' => 'required|integer', 
            'mes' => 'required|integer'
        ];

        if($tipoReporte == 2){
            $reglas['fecha'] = 'required|date_format:d/m/Y';

        } else if($tipoReporte == 3){
            $reglas['identificacion'] = 'required|exists:se_personas,identificacion';
        }

        $request->validate( $reglas, [
            'anio.required' => 'Se requiere que elija un año',
            'anio.integer' => 'El año debe ser de tipo entero',

            'mes.required' => 'Se requiere que eilija un mes',
            'mes.integer' => 'El mes debe ser de tipo entero',

            'fecha.required' => 'Se requiere que ingrese la fecha',
            'fecha.date_format' => 'La fecha debe tener un formato valido',

            'identificacion.required' => 'Se requiere que ingrese el número de indentificación de la persona',
            'identificacion.exists' => 'La identificación ingresada no existe en el sistema'
        ]);
    }

    /**
     * Función que realiza una consulta general a la base de datos de todos los registros de ingresos de los diferentes tipos de personas.
     */
    public function consultaGeneral()
    {
        try {
            return Registro::select('se_registros.*', 'personas.nombre', 'personas.apellido', 'personas.identificacion', 'personas.id_tipo_persona', 'tpersona.tipo AS tipopersona', 'v_empresa.nombre AS empresavisitada', 'c_empresa.nombre AS empresa', 'vehiculos.identificador','usuarios.name', 'usuarios.city')
            ->leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_tipo_personas AS tpersona', 'personas.id_tipo_persona', '=', 'tpersona.id_tipo_personas')
            ->leftjoin('se_empresas AS v_empresa', 'se_registros.empresa_visitada', '=', 'v_empresa.id_empresas')
            ->leftjoin('se_empresas AS c_empresa', 'personas.id_empresa', '=', 'c_empresa.id_empresas')
            ->leftjoin('se_vehiculos AS vehiculos', 'se_registros.id_vehiculo', '=', 'vehiculos.id_vehiculos')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->orderBy('id_registros');
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta general y filtra la información por un año y mes determinados.
     */
    public function reporteAgrupadoAnioMes($anio, $mes)
    {
        try {
            return $this->consultaGeneral()->whereYear('ingreso_persona', $anio)->whereMonth('ingreso_persona', $mes);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte agrupado por año y mes y filtra la información por un tipo de persona (visitantes, colaboradores, colaboradores con activo, conductores).
     */
    public function reporteAgrupadoTipoPersona($anio, $mes, $tipoPersona)
    {
        try {
            if($tipoPersona == 1){
                return $this->reporteAgrupadoAnioMes($anio, $mes)->where('id_tipo_persona', '!=', 4)->whereNotNull('empresa_visitada');
            } else if ($tipoPersona == 2){
                return $this->reporteAgrupadoAnioMes($anio, $mes)->where('id_tipo_persona', 2)->whereNull('empresa_visitada');
            } else if ($tipoPersona == 3){
                return $this->reporteAgrupadoAnioMes($anio, $mes)->where('id_tipo_persona', 3)->whereNull('empresa_visitada')->whereNotNull('ingreso_activo');
            } else {
                return $this->reporteAgrupadoAnioMes($anio, $mes)->where('id_tipo_persona', 4);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte agrupado por año y mes y filtra la información por una ciudad determinada (Bogotá, Cartagena, Buenaventura).
     */
    public function reporteAgrupadoCiudad($anio, $mes, $ciudad)
    {
        try {
            return $this->reporteAgrupadoAnioMes($anio, $mes)->where('city', $ciudad);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte agrupado por tipo de persona y filtra la información por una ciudad determinada (Bogotá, Cartagena, Buenaventura).
     */
    public function reporteAgrupado_tipoPersona_ciudad($anio, $mes, $tipoPersona, $ciudad)
    {
        try {
            return $this->reporteAgrupadoTipoPersona($anio, $mes, $tipoPersona)->where('city', $ciudad);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte agrupado por tipo de persona para traer los registros de ingresos de visitantes y filtra la información por una empresa determinada (Aviomar, Snider, Colvan).
     */
    public function reporteAgrupado_visitantes_empresa($anio, $mes, $tipoPersona, $empresa)
    {
        try {
            return $this->reporteAgrupadoTipoPersona($anio, $mes, $tipoPersona)->where('empresa_visitada', $empresa);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     *  Función que hace uso de la consulta de reporte agrupado por tipo de persona para traer los registros de ingresos de visitantes y filtra la información por una empresa (Aviomar, Snider, Colvan) y ciudad (Bogotá, Cartagena, Buenaventura) determinadas.
     */
    public function reporteAgrupado_visitantes_empresa_ciudad($anio, $mes, $tipoPersona, $empresa, $ciudad)
    {
        try {
            return $this->reporteAgrupadoTipoPersona($anio, $mes, $tipoPersona)->where('empresa_visitada', $empresa)->where('city', $ciudad);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta general y filtra la información por una fecha específica.
     */
    public function reporteFechaEspecifica($fecha)
    {
        try {
            return $this->consultaGeneral()->whereDate('ingreso_persona', $fecha);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte por fecha específica y filtra la información por un tipo de persona (visitantes, colaboradores, colaboradores con activo, conductores).
     */
    public function reporteFechaEspecificaTipoPersona($fecha, $tipoPersona)
    {
        try {
            if($tipoPersona == 1){
                return $this->reporteFechaEspecifica($fecha)->where('id_tipo_persona', '!=', 4)->whereNotNull('empresa_visitada');
            } else if ($tipoPersona == 2){
                return $this->reporteFechaEspecifica($fecha)->where('id_tipo_persona', 2)->whereNull('empresa_visitada');
            } else if ($tipoPersona == 3){
                return $this->reporteFechaEspecifica($fecha)->where('id_tipo_persona', 3)->whereNull('empresa_visitada')->whereNotNull('ingreso_activo');
            } else {
                return $this->reporteFechaEspecifica($fecha)->where('id_tipo_persona', 4);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte por fecha específica y filtra la información por una ciudad determinada (Bogotá, Cartagena, Buenaventura).
     */
    public function reporteFechaEspecificaCiudad($fecha, $ciudad)
    {
        try {
            return $this->reporteFechaEspecifica($fecha)->where('city', $ciudad);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte por fecha específica por tipo de persona y filtra la información por una ciudad determinada (Bogotá, Cartagena, Buenaventura).
     */
    public function reporteFechaEspecifica_tipoPersona_ciudad($fecha, $tipoPersona, $ciudad)
    {
        try {
            return $this->reporteFechaEspecificaTipoPersona($fecha, $tipoPersona)->where('city', $ciudad);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte por fecha específica por tipo de persona para traer los registros de ingresos de visitantes y filtra la información por una empresa determinada (Aviomar, Snider, Colvan).
     */
    public function reporteFechaEspecifica_visitantes_empresa($fecha, $tipoPersona, $empresa)
    {
        try {
            return $this->reporteFechaEspecificaTipoPersona($fecha, $tipoPersona)->where('empresa_visitada', $empresa);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     *  Función que hace uso de la consulta de reporte por fecha específica por tipo de persona para traer los registros de ingresos de visitantes y filtra la información por una empresa (Aviomar, Snider, Colvan) y ciudad (Bogotá, Cartagena, Buenaventura) determinadas.
     */
    public function reporteFechaEspecifica_visitantes_empresa_ciudad($fecha, $tipoPersona, $empresa, $ciudad)
    {
        try {
            return $this->reporteFechaEspecificaTipoPersona($fecha, $tipoPersona)->where('empresa_visitada', $empresa)->where('city', $ciudad);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que hace uso de la consulta de reporte agrupado por tipo de persona y filtra la información por la identificación de una persona determinada.
     */
    public function reporteIndividualMes($anio, $mes, $identificacion)
    {
        try {
            return $this->reporteAgrupadoAnioMes($anio, $mes)->where('identificacion', $identificacion);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}