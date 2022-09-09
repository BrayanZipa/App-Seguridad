<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;
use Carbon\Carbon;
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
        $colaboradoresActivo = $this->totalColaboradoresActivoDiarios(3);
        $vehiculos = $this->totalVehiculosDiarios();
        return view('pages.home.dashboard',  compact('visitantes', 'conductores', 'colaboradoresActivo', 'vehiculos'));
    }

    /**
     * 
     */
    public function definirConsulta($consulta)
    {
        if(auth()->user()->hasRole(['Admin', 'Seguridad'])){
            return $consulta->count();
        } 
        return $consulta->where('city', auth()->user()->city)->count();
    }

    /**
     * 
     */
    public function totalPersonasDiarias($tipoPersona)
    {
        try {  
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', $tipoPersona)->whereDate('ingreso_persona', Carbon::now()->toDateString());
            return $this->definirConsulta($consulta);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function totalColaboradoresActivoDiarios($tipoPersona)
    {
        try { 
            $consulta = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->where('id_tipo_persona', $tipoPersona)->whereNotNull('ingreso_activo')->whereDate('ingreso_persona', Carbon::now()->toDateString());
            return $this->definirConsulta($consulta);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function totalVehiculosDiarios()
    {
        try {       
            $consulta = Registro::leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
            ->whereDate('ingreso_vehiculo', Carbon::now()->toDateString());
            return $this->definirConsulta($consulta);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
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