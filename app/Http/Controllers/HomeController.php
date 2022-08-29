<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $user = User::find(auth()->user()->id_usuarios);
        // $roles = $user->getRoleNames();

        // if (empty($roles[0])) {

        //     $user->assignRole(2);

        // }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $visitantes = $this->totalPersonasDiarias(1);
        $conductores = $this->totalPersonasDiarias(4);
        $colaboradoresActivo = $this->totalColaboradoresActivoDiarios(3);
        $vehiculos = $this->totalVehiculosDiarios();
        return view('pages.home.dashboard',  compact('visitantes', 'conductores', 'colaboradoresActivo', 'vehiculos'));
    }

    /**
     * 
     */
    public function totalPersonasDiarias($tipoPersona)
    {
        try {       
            $numRegistros = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->where('id_tipo_persona', $tipoPersona)->whereDate('ingreso_persona', Carbon::now()->toDateString())->count();
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $numRegistros;
    }

    /**
     * 
     */
    public function totalColaboradoresActivoDiarios($tipoPersona)
    {
        try {       
            $numColaboradores = Registro::leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
            ->where('id_tipo_persona', $tipoPersona)->whereNotNull('ingreso_activo')->whereDate('ingreso_persona', Carbon::now()->toDateString())->count();
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $numColaboradores;
    }

    /**
     * 
     */
    public function totalVehiculosDiarios()
    {
        try {       
            $numVehiculos = Registro::whereDate('ingreso_vehiculo', Carbon::now()->toDateString())->count();
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $numVehiculos;
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

    

    public function prueba()
    {
        // $date = Carbon::now();
        
        return Carbon::now()->toDateString();
    }
}
