<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use App\Exports\ReportesExport;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Registro;
use Carbon\Carbon;

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
        $this->usuarios->asiganrRol(auth()->user());
        return view('pages.reportes.reportes');
    }

    /**
     * Función que verifica el tipo de formato en el que se solicita un determinado reporte.
     */
    public function exportarReportes(Request $request) 
    {
        $this->validarFiltros($request);
        $datos = $request->all();

        if($datos['formato'] == 'excel'){
            return $this->exportarReportesExcel($datos);
        } else if($datos['formato'] == 'pdf'){
            return $this->exportarReportesPdf($datos);
        }
    }

    /**
     * Función que permite exportar reportes de las consultas realizadas a la base de datos en formato Excel dependiendo de los datos enviados en los filtros de la interfaz.
     */
    public function exportarReportesExcel($datos)
    {
        $registrosCompletos = false;

        if($datos['tipoReporte'] == 1 || $datos['tipoReporte'] == 2){
            if(isset($datos['tipoPersona']) && $datos['tipoPersona'] != 5) {
                [$esColaborador, $esColOrVisi, $tipoPersona] = $this->determinarTipoPersona($datos['tipoPersona']);
            }

            if(isset($datos['fecha'])){
                $fecha = Carbon::createFromFormat('d/m/Y', $datos['fecha']);
                $datos['fecha'] = $fecha->toDateString();
            }

            if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
                $registrosCompletos = true;
                $esColaborador = false;
                $esColOrVisi = false;
                if($datos['tipoReporte'] == 1){
                    $titulo = 'Registros '.$datos['mes'].'-'.$datos['anio'];
                    $consulta = $this->reporteAgrupadoAnioMes($datos['anio'], $datos['mes'])->get();
                } else {
                    $titulo = 'Registros '.$fecha->format('d-m-Y');
                    $consulta = $this->reporteFechaEspecifica($datos['fecha'])->get();
                }
                
            } else if(isset($datos['tipoPersona']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas') && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
                if($datos['tipoReporte'] == 1){
                    $titulo = $tipoPersona.' '.$datos['mes'].'-'.$datos['anio'];
                    $consulta = $this->reporteAgrupadoTipoPersona($datos['anio'], $datos['mes'], $datos['tipoPersona'])->get();
                } else {
                    $titulo = $tipoPersona.' '.$fecha->format('d-m-Y');
                    $consulta = $this->reporteFechaEspecificaTipoPersona($datos['fecha'], $datos['tipoPersona'])->get();
                }  
                    
            } else if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && isset($datos['ciudad'])){
                $registrosCompletos = true;
                $esColaborador = false;
                $esColOrVisi = false;
                if($datos['tipoReporte'] == 1){
                    $titulo = 'Registros '.$datos['ciudad'].' '.$datos['mes'].'-'.$datos['anio'];
                    $consulta = $this->reporteAgrupadoCiudad($datos['anio'], $datos['mes'], $datos['ciudad'])->get();
                } else {
                    $titulo = 'Registros '.$datos['ciudad'].' '.$fecha->format('d-m-Y');
                    $consulta = $this->reporteFechaEspecificaCiudad($datos['fecha'], $datos['ciudad'])->get();
                } 
            
            } else if((isset($datos['tipoPersona'])) && isset($datos['ciudad']) && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
                if($datos['tipoReporte'] == 1){
                    $titulo = $tipoPersona.' '.$datos['ciudad'].' '.$datos['mes'].'-'.$datos['anio'];
                    $consulta = $this->reporteAgrupado_tipoPersona_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['ciudad'])->get();
                } else {
                    $titulo = $tipoPersona.' '.$datos['ciudad'].' '.$fecha->format('d-m-Y');
                    $consulta = $this->reporteFechaEspecifica_tipoPersona_ciudad($datos['fecha'], $datos['tipoPersona'], $datos['ciudad'])->get();
                } 

            } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
                if($datos['tipoReporte'] == 1){
                    $titulo = $tipoPersona.' '.Empresa::find($datos['empresa'])->nombre.' '.$datos['mes'].'-'.$datos['anio'];
                    $consulta = $this->reporteAgrupado_visitantes_empresa($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'])->get();
                } else {
                    $titulo = $tipoPersona.' '.Empresa::find($datos['empresa'])->nombre.' '.$fecha->format('d-m-Y');
                    $consulta = $this->reporteFechaEspecifica_visitantes_empresa($datos['fecha'], $datos['tipoPersona'], $datos['empresa'])->get();
                } 
                
            } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && isset($datos['ciudad'])){
                if($datos['tipoReporte'] == 1){
                    $titulo = $tipoPersona.' '.Empresa::find($datos['empresa'])->nombre.' '.$datos['ciudad'].' '.$datos['mes'].'-'.$datos['anio'];
                    $consulta = $this->reporteAgrupado_visitantes_empresa_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get();
                } else {
                    $titulo = $tipoPersona.' '.Empresa::find($datos['empresa'])->nombre.' '.$datos['ciudad'].' '.$fecha->format('d-m-Y');
                    $consulta = $this->reporteFechaEspecifica_visitantes_empresa_ciudad($datos['fecha'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get();
                }  
            }
        } else {
            [$esColaborador, $esColOrVisi, $tipoPersona] = $this->determinarTipoPersona(Persona::where('identificacion', $datos['identificacion'])->first()->id_tipo_persona);
            $titulo = $datos['identificacion'].' '.$datos['mes'].'-'.$datos['anio'];
            $consulta = $this->reporteIndividualMes($datos['anio'], $datos['mes'], $datos['identificacion'])->get();
        }

        return (new ReportesExport($consulta, $registrosCompletos, $esColaborador, $esColOrVisi, $titulo))->download($titulo.'.xlsx');
    }

    /**
     * Función que permite exportar reportes de las consultas realizadas a la base de datos en formato PDF dependiendo de los datos enviados en los filtros de la interfaz.
     */
    public function exportarReportesPdf($datos) 
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 3600); 
        $registrosCompletos = false;

        if($datos['tipoReporte'] == 1 || $datos['tipoReporte'] == 2){
            if(isset($datos['tipoPersona']) && $datos['tipoPersona'] != 5) {
                [$esColaborador, $esColOrVisi, $tipoPersona] = $this->determinarTipoPersona($datos['tipoPersona']);
            }

            if(isset($datos['fecha'])){
                $fecha = Carbon::createFromFormat('d/m/Y', $datos['fecha']);
                $datos['fecha'] = $fecha->toDateString();
            }

            if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
                $registrosCompletos = true;
                $esColaborador = false;
                $esColOrVisi = false;
                if($datos['tipoReporte'] == 1){
                    $titulo = 'Registros '.$datos['mes'].'-'.$datos['anio'];
                    $reportes = $this->reporteAgrupadoAnioMes($datos['anio'], $datos['mes'])->get();
                } else {
                    $titulo = 'Registros '.$fecha->format('d-m-Y');
                    $reportes = $this->reporteFechaEspecifica($datos['fecha'])->get();
                }
                
            } else if(isset($datos['tipoPersona']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas') && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
                if($datos['tipoReporte'] == 1){
                    $titulo = $tipoPersona.' '.$datos['mes'].'-'.$datos['anio'];
                    $reportes = $this->reporteAgrupadoTipoPersona($datos['anio'], $datos['mes'], $datos['tipoPersona'])->get();
                } else {
                    $titulo = $tipoPersona.' '.$fecha->format('d-m-Y');
                    $reportes = $this->reporteFechaEspecificaTipoPersona($datos['fecha'], $datos['tipoPersona'])->get();
                }
                    
            } else if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && isset($datos['ciudad'])){
                $registrosCompletos = true;
                $esColaborador = false;
                $esColOrVisi = false;
                if($datos['tipoReporte'] == 1){
                    $titulo = 'Registros '.$datos['ciudad'].' '.$datos['mes'].'-'.$datos['anio'];
                    $reportes = $this->reporteAgrupadoCiudad($datos['anio'], $datos['mes'], $datos['ciudad'])->get();
                } else {
                    $titulo = 'Registros '.$datos['ciudad'].' '.$fecha->format('d-m-Y');
                    $reportes = $this->reporteFechaEspecificaCiudad($datos['fecha'], $datos['ciudad'])->get();
                }
            
            } else if((isset($datos['tipoPersona'])) && isset($datos['ciudad']) && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
                if($datos['tipoReporte'] == 1){
                    $titulo = $tipoPersona.' '.$datos['ciudad'].' '.$datos['mes'].'-'.$datos['anio'];
                    $reportes = $this->reporteAgrupado_tipoPersona_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['ciudad'])->get();
                } else {
                    $titulo = $tipoPersona.' '.$datos['ciudad'].' '.$fecha->format('d-m-Y');
                    $reportes = $this->reporteFechaEspecifica_tipoPersona_ciudad($datos['fecha'], $datos['tipoPersona'], $datos['ciudad'])->get();
                } 

            } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
                if($datos['tipoReporte'] == 1){
                    $titulo = $tipoPersona.' '.Empresa::find($datos['empresa'])->nombre.' '.$datos['mes'].'-'.$datos['anio'];
                    $reportes = $this->reporteAgrupado_visitantes_empresa($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'])->get();
                } else {
                    $titulo = $tipoPersona.' '.Empresa::find($datos['empresa'])->nombre.' '.$fecha->format('d-m-Y');
                    $reportes = $this->reporteFechaEspecifica_visitantes_empresa($datos['fecha'], $datos['tipoPersona'], $datos['empresa'])->get();
                }
                
            } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && isset($datos['ciudad'])){
                if($datos['tipoReporte'] == 1){
                    $titulo = $tipoPersona.' '.Empresa::find($datos['empresa'])->nombre.' '.$datos['ciudad'].' '.$datos['mes'].'-'.$datos['anio'];
                    $reportes = $this->reporteAgrupado_visitantes_empresa_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get();
                } else {
                    $titulo = $tipoPersona.' '.Empresa::find($datos['empresa'])->nombre.' '.$datos['ciudad'].' '.$fecha->format('d-m-Y');
                    $reportes = $this->reporteFechaEspecifica_visitantes_empresa_ciudad($datos['fecha'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get();
                }  
            }
        } else {
            [$esColaborador, $esColOrVisi, $tipoPersona] = $this->determinarTipoPersona(Persona::where('identificacion', $datos['identificacion'])->first()->id_tipo_persona);
            $titulo = $datos['identificacion'].' '.$datos['mes'].'-'.$datos['anio'];
            $reportes = $this->reporteIndividualMes($datos['anio'], $datos['mes'], $datos['identificacion'])->get();
        }

        $reportePdf = PDF::loadView('pages.reportes.plantillaExportarPdf', compact('reportes', 'registrosCompletos', 'esColaborador', 'esColOrVisi', 'titulo'));
        $reportePdf->set_paper('letter', 'landscape');

        return $reportePdf->download($titulo.'.pdf');
    }

    /**
     * Función que permite validar los datos enviados en los filtros de información de los diferentes tipos de reportes
     */
    public function validarFiltros(Request $request){
        $tipoReporte = $request->input('tipoReporte');
        $reglas = [
            'anio' => 'required|numeric', 
            'mes' => 'required|numeric'
        ];

        if($tipoReporte == 2){
            $reglas['fecha'] = 'required|date_format:d/m/Y';
        } else if($tipoReporte == 3){
            $reglas['identificacion'] = 'required|exists:se_personas,identificacion';
        }

        $request->validate( $reglas, [
            'anio.required' => 'Se requiere que elija un año',
            'anio.numeric' => 'El año debe ser un número',

            'mes.required' => 'Se requiere que eilija un mes',
            'mes.numeric' => 'El mes debe ser un número',

            'fecha.required' => 'Se requiere que ingrese la fecha',
            'fecha.date_format' => 'La fecha debe tener un formato valido',

            'identificacion.required' => 'Se requiere que ingrese el número de indentificación de la persona',
            'identificacion.exists' => 'La identificación ingresada no existe en el sistema'
        ]);
    }

    /**
     * Función que permite verificar el tipo de persona que se haya elejido en los filtros de información y de esta manera establecer varibles que permitiran mostrar información dependiendo del tipo de persona.
     */
    public function determinarTipoPersona($tipoPersona) 
    {
        if($tipoPersona == 1 || $tipoPersona == 4){
            $esColaborador = false;
            $esColOrVisi= false;
            if($tipoPersona == 1){
                $esColOrVisi = true;
                $tipoPersona = 'Visitantes';
            } else {
                $tipoPersona = 'Conductores';
            }
        } else if($tipoPersona == 2 || $tipoPersona == 3){
            $esColaborador = true;
            $esColOrVisi = false;
            if($tipoPersona == 3){
                $esColOrVisi = true;
                $tipoPersona = 'Colaboradores con activo';
            } else {
                $tipoPersona = 'Colaboradores';
            }
        }  
        return [$esColaborador, $esColOrVisi, $tipoPersona];
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
     * Función que recibe una petición Ajax para obtener los registros de ingresos de los diferentes tipos de personas dependiendo de los datos que se hayan enviado desde la interfaz.
     */
    public function informacionReportes(Request $request)
    {
        $datos = $request->all();
        if($request->ajax()){

            if(isset($datos['fecha'])){
                $datos['fecha'] = Carbon::createFromFormat('d/m/Y', $datos['fecha'])->toDateString();
            }
            if($datos['tipoReporte'] == 1 || $datos['tipoReporte'] == 2){
                if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
                    if($datos['tipoReporte'] == 1){
                        $registros = $this->reporteAgrupadoAnioMes($datos['anio'], $datos['mes'])->get();
                    } else {
                        $registros = $this->reporteFechaEspecifica($datos['fecha'])->get();
                    }
                    
                } else if(isset($datos['tipoPersona']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas') && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
                    if($datos['tipoReporte'] == 1){
                        $registros = $this->reporteAgrupadoTipoPersona($datos['anio'], $datos['mes'], $datos['tipoPersona'])->get();
                    } else {
                        $registros = $this->reporteFechaEspecificaTipoPersona($datos['fecha'], $datos['tipoPersona'])->get();
                    }  
                        
                } else if((!isset($datos['tipoPersona']) || $datos['tipoPersona'] == 5) && isset($datos['ciudad'])){
                    if($datos['tipoReporte'] == 1){
                        $registros = $this->reporteAgrupadoCiudad($datos['anio'], $datos['mes'], $datos['ciudad'])->get();
                    } else {
                        $registros = $this->reporteFechaEspecificaCiudad($datos['fecha'], $datos['ciudad'])->get();
                    } 
                
                } else if((isset($datos['tipoPersona'])) && isset($datos['ciudad']) && (!isset($datos['empresa']) || $datos['empresa'] == 4)){
                    if($datos['tipoReporte'] == 1){
                        $registros = $this->reporteAgrupado_tipoPersona_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['ciudad'])->get();
                    } else {
                        $registros = $this->reporteFechaEspecifica_tipoPersona_ciudad($datos['fecha'], $datos['tipoPersona'], $datos['ciudad'])->get();
                    } 

                } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && (!isset($datos['ciudad']) || $datos['ciudad'] == 'Todas')){
                    if($datos['tipoReporte'] == 1){
                        $registros = $this->reporteAgrupado_visitantes_empresa($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'])->get();
                    } else {
                        $registros = $this->reporteFechaEspecifica_visitantes_empresa($datos['fecha'], $datos['tipoPersona'], $datos['empresa'])->get();
                    } 
                    
                } else if($datos['tipoPersona'] == 1 && isset($datos['empresa']) && isset($datos['ciudad'])){
                    if($datos['tipoReporte'] == 1){
                        $registros = $this->reporteAgrupado_visitantes_empresa_ciudad($datos['anio'], $datos['mes'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get();
                    } else {
                        $registros = $this->reporteFechaEspecifica_visitantes_empresa_ciudad($datos['fecha'], $datos['tipoPersona'], $datos['empresa'], $datos['ciudad'])->get();
                    }  
                }
            } else if($datos['tipoReporte'] == 3) {
                $registros = $this->reporteIndividualMes($datos['anio'], $datos['mes'], $datos['identificacion'])->get();
            } else {
                $registros = $this->reporteAgrupadoAnioMes($datos['anio'], $datos['mes'])->get();
            }

            return DataTables::of($registros)->make(true);
        }
    }
}