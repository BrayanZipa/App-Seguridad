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
     * Función que permite traer el número total de registros por medio de una consulta previamente realizada y dependiendo del rol de usuario y la ciudad que este tenga asignada.
     */
    public function definirConsulta($consulta, $ciudad = null)
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

    // /**
    //  * 
    //  */
    // public function obtenerVisitantesDiarios($fechaActual)
    // {
    //     try {       
    //         $visitantes = Registro::where('id_persona', 1)->whereDate('ingreso_persona', $fechaActual)->count();
    //     } catch (\Throwable $e) {
    //         return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
    //     }
    //     return $visitantes;
    // }

    // /**
    //  * 
    //  */
    // public function obtenerColaboradoresDiarios($fechaActual)
    // {
    //     try {       
    //         $colaboradores = Registro::where('id_persona', 2)->whereDate('ingreso_persona', $fechaActual)->count();
    //     } catch (\Throwable $e) {
    //         return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
    //     }
    //     return $colaboradores;
    // }

    // /**
    //  * 
    //  */
    // public function obtenerColaboradoresActivoDiarios($fechaActual)
    // {
    //     try {       
    //         $colaboradores = Registro::where('id_persona', 3)->whereDate('ingreso_persona', $fechaActual)->count();
    //     } catch (\Throwable $e) {
    //         return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
    //     }
    //     return $colaboradores;
    // }

    // /**
    //  * 
    //  */
    // public function obtenerConductoresDiarios($fechaActual)
    // {
    //     try {       
    //         $colaboradores = Registro::where('id_persona', 4)->whereDate('ingreso_persona', $fechaActual)->count();
    //     } catch (\Throwable $e) {
    //         return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
    //     }
    //     return $colaboradores;
    // }

    

    // public function prueba()
    // {
    //     // $date = Carbon::now();
        
    //     return Carbon::now()->toDateString();
    // }
}