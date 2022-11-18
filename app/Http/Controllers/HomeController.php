<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    protected $usuarios;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $exitCode = Artisan::call('cache:clear');
        $this->usuarios->asiganrRol(auth()->user());
        $visitantes = $this->totalPersonasDiarias(1);
        $conductores = $this->totalPersonasDiarias(4);
        $colaboradoresActivo = $this->totalColaboradoresActivoDiarios();
        $vehiculos = $this->totalVehiculosDiarios();

        // $visitantes = 15;
        // $conductores = 8;
        // $colaboradoresActivo = 4;
        // $vehiculos = 11;
        
        return view('pages.home.dashboard',  compact('visitantes', 'conductores', 'colaboradoresActivo', 'vehiculos'));
    }

    /**
     * Función que permite consultar los registros de un tipo de persona elegido, los cuales se hayan ingresado el día actual en la tabla se_registros.
     */
    public function totalPersonasDiarias($tipoPersona, $ciudad = null)
    {
        try {  
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', $tipoPersona)->whereDate('ingreso_persona', Carbon::now()->toDateString())->whereNull('salida_persona');
            return $this->definirConsulta($consulta, $ciudad);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que permite consultar los registros de los colaboradores con activo, los cuales se hayan ingresado el día actual en la tabla se_registros.
     */
    public function totalColaboradoresActivoDiarios($ciudad = null)
    {
        try { 
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', 3)->whereNotNull('ingreso_activo')->whereDate('ingreso_persona', Carbon::now()->toDateString())->whereNull('salida_persona');
            return $this->definirConsulta($consulta, $ciudad);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que permite consultar los registros de los vehículos, los cuales se hayan ingresado el día actual en la tabla se_registros.
     */
    public function totalVehiculosDiarios($ciudad = null)
    {
        try {       
            $consulta = Registro::leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->whereDate('ingreso_vehiculo', Carbon::now()->toDateString())->whereNull('salida_vehiculo');
            return $this->definirConsulta($consulta, $ciudad);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que recibe una petición Ajax para consultar el número de registros de visitantes, colaboradores con activo, conductores y vehículos en la tabla se_registros, los cuales se hayan ingresado el día actual y por una ciudad en específico.
     */
    public function totalRegistrosDiarios(Request $request)
    {
        if($request->ajax()){
            $ciudad = $request->input('ciudad');
            $visitantes = $this->totalPersonasDiarias(1, $ciudad);
            $conductores = $this->totalPersonasDiarias(4, $ciudad);
            $colaboradoresActivo = $this->totalColaboradoresActivoDiarios($ciudad);
            $vehiculos = $this->totalVehiculosDiarios($ciudad);

            return response()->json([
                'visitantes' => $visitantes,
                'conductores' => $conductores,
                'colaboradoresActivo' => $colaboradoresActivo,
                'vehiculos' => $vehiculos
            ]);

            // return response()->json([
            //     'visitantes' => 5,
            //     'conductores' => 10,
            //     'colaboradoresActivo' => 12,
            //     'vehiculos' => 8
            // ]);
        }
    }

    
                                
    /**
     * Función que permite consultar en la base de datos el total de visitantes que registraron ingresos a la empresa en un año y mes determinados.
     */
    public function totalVisitantesPorMes($anio, $mes, $ciudad)
    {
        try {
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', '!=', 4)->where('empresa_visitada', '!=', null)->whereYear('ingreso_persona', $anio)->whereMonth('ingreso_persona', $mes);

            // return $consulta->get();
            // return $consulta->count();
            return $this->definirConsulta($consulta, $ciudad);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que permite consultar en la base de datos el total de colaboradores con activo que registraron ingresos a la empresa en un año y mes determinados.
     */
    public function totalColaboradoresActivoPorMes($anio, $mes, $ciudad)
    {
        try { 
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', 3)->whereNotNull('ingreso_activo')->whereYear('ingreso_persona', $anio)->whereMonth('ingreso_persona', $mes);

            // return $consulta->count();
            return $this->definirConsulta($consulta, $ciudad);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que permite consultar en la base de datos el total de conductores que registraron ingresos a la empresa en un año y mes determinados.
     */
    public function totalConductoresPorMes($anio, $mes, $ciudad)
    {
        try {
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', 4)->whereYear('ingreso_persona', $anio)->whereMonth('ingreso_persona', $mes);

            // return $consulta->get();
            // return $consulta->count();
            return $this->definirConsulta($consulta, $ciudad);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

        // public function totalPersonasPorMes($tipoPersona, $anio, $mes, $ciudad)
    // {
    //     try {
    //         $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
    //         ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
    //         ->where('id_tipo_persona', $tipoPersona)->whereYear('ingreso_persona', $anio)->whereMonth('ingreso_persona', $mes);

    //         // return $consulta->get();
    //         // return $consulta->count();
    //         return $this->definirConsulta($consulta, $ciudad);

    //     } catch (\Throwable $th) {
    //         return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
    //     }
    // }

    /**
     * Función que permite consultar en la base de datos el total de vehículos que registraron ingresos a la empresa en un año y mes determinados.
     */
    public function totalVehiculosPorMes($anio, $mes, $ciudad)
    {
        try {       
            $consulta = Registro::leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->whereYear('ingreso_vehiculo', $anio)->whereMonth('ingreso_vehiculo', $mes);

            // return $consulta->get();
            // return $consulta->count();
            return $this->definirConsulta($consulta, $ciudad);

        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que recibe una petición Ajax para consultar en la base de datos el número de registros de ingresos de visitantes, colaboradores con activo, conductores y vehículos del mes actual y los cinco meses anteriores a este.
     */
    public function totalIngresosPorMes(Request $request)
    {
        if($request->ajax()){
            $ciudad = $request->input('ciudad');
            $meses = [];
            $visitantes = [];
            $colaboradoresActivo = [];
            $conductores = [];
            $vehiculos = [];

            for ($i = 0; $i < 6; $i++) { 
                // $mesAnterior = Carbon::parse('03-03-2024')->subMonth($i);
                $mesAnterior = Carbon::now()->subMonth($i);
                array_unshift($meses, $mesAnterior->format('m-Y'));

                array_unshift($visitantes, $this->totalVisitantesPorMes($mesAnterior->year, $mesAnterior->month, $ciudad));
                array_unshift($colaboradoresActivo, $this->totalColaboradoresActivoPorMes($mesAnterior->year, $mesAnterior->month, $ciudad));
                array_unshift($conductores, $this->totalConductoresPorMes($mesAnterior->year, $mesAnterior->month, $ciudad));
                array_unshift($vehiculos, $this->totalVehiculosPorMes($mesAnterior->year, $mesAnterior->month, $ciudad));
                // array_unshift($visitantes, $this->totalPersonasPorMes(1, $mesAnterior->year, $mesAnterior->month, $ciudad));
                // array_unshift($conductores, $this->totalPersonasPorMes(4, $mesAnterior->year, $mesAnterior->month, $ciudad));
            }
            
            return response()->json([
                'meses' => $meses,
                'totalIngresosPorMes' => [$visitantes, $colaboradoresActivo, $conductores, $vehiculos]
            ]);
        }
    }

    /**
     * Función que permite consultar en la base de datos el total de visitantes que registraron un ingreso a una determinada empresa en un año y mes específicos.
     */
    public function totalVisitantesPorEmpresa($empresa, $anio, $mes, $ciudad)
    {
        try {
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', '!=', 4)->where('empresa_visitada', $empresa)->whereYear('ingreso_persona', $anio)->whereMonth('ingreso_persona', $mes);

            // return $consulta->get();
            // return $consulta->count();
            return $this->definirConsulta($consulta, $ciudad);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que recibe una petición Ajax para consultar en la base de datos el número de registros de ingresos de visitantes del mes actual y los cinco meses anteriores a este didividos por la empresa donde se realizo el ingreso.
     */
    public function totalIngresosVisitantesPorMes(Request $request)
    {
        if($request->ajax()){
            $ciudad = $request->input('ciudad');

            for ($i = 0; $i < 6; $i++) { 
                // $mesAnterior = Carbon::parse('03-03-2024')->subMonth($i);
                $mesAnterior = Carbon::now()->subMonth($i);
                $meses[] = $mesAnterior->format('m-Y');

                $visitantesAviomar[] = $this->totalVisitantesPorEmpresa(1, $mesAnterior->year, $mesAnterior->month, $ciudad);
                $visitantesSnider[] = $this->totalVisitantesPorEmpresa(2, $mesAnterior->year, $mesAnterior->month, $ciudad);
                $visitantesColvan[] = $this->totalVisitantesPorEmpresa(3, $mesAnterior->year, $mesAnterior->month, $ciudad);
            }

            return response()->json([
                'meses' => $meses,
                'totalIngresosVisitantesPorMes' => [$visitantesAviomar, $visitantesSnider, $visitantesColvan]
            ]);
        }
    }

    /**
     * Función que permite consultar en la base de datos el total de visitantes que registraron un ingreso a una determinada empresa en un año específico.
     */
    public function totalVisitantesPorAnio($empresa, $anio, $ciudad)
    {
        try {
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', '!=', 4)->where('empresa_visitada', $empresa)->whereYear('ingreso_persona', $anio);

            // return $consulta->get();
            // return $consulta->count();
            return $this->definirConsulta($consulta, $ciudad);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * Función que recibe una petición Ajax para consultar en la base de datos el número de registros de ingresos de visitantes del año actual y divididos por la empresa donde se realizo el ingreso.
     */
    public function totalIngresosVisitantesAnio(Request $request)
    {
        if($request->ajax()){
            $ciudad = $request->input('ciudad');
            $anioActual = Carbon::now()->year;

            return response()->json([
                'anio' => $anioActual,
                'totalIngresosVisitantesAnio' => [
                    $this->totalVisitantesPorAnio(1, $anioActual, $ciudad),
                    $this->totalVisitantesPorAnio(2, $anioActual, $ciudad),
                    $this->totalVisitantesPorAnio(3, $anioActual, $ciudad)
                ]
            ]);
        }
    }

    /**
     * Función que permite traer el número total de registros por medio de una consulta previamente realizada y dependiendo del rol de usuario y la ciudad que este tenga asignada.
     */
    public function definirConsulta($consulta, $ciudad)
    {
        try {  
            if(auth()->user()->hasRole(['Admin', 'Seguridad'])){
                if($ciudad != null){
                    return $consulta->where('city', $ciudad)->count();
                }
                return $consulta->count();
            } 
            return $consulta->where('city', auth()->user()->city)->count();
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }
}