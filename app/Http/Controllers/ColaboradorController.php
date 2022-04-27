<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\Arl;
use App\Models\Empresa;
use App\Models\Eps;
use App\Models\Persona;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class ColaboradorController extends Controller
{
    protected $colaboradores;
    protected $eps;
    protected $arl;
    protected $empresas;

    public function __construct(Persona $colaboradores, Eps $eps, Arl $arl, Empresa $empresas){
        $this->colaboradores = $colaboradores;
        $this->eps = $eps;
        $this->arl = $arl;
        $this->empresas = $empresas;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitCode = Artisan::call('cache:clear');

        // $session_token = Http::withHeaders([
        //     'Authorization' => 'user_token '.env('API_KEY', 'No hay Token')
        // ])->get(env('API_URL', 'No hay URL').'initSession/');

        // // return 'Session-Token: '.$session_token['session_token'];

        // $usuarios = Http::withHeaders([
        //     'Session-Token' => $session_token['session_token']
        // ])->get(env('API_URL', 'No hay URL').'computer/', [
        //     'range' => '0-300'
        //     // "items" => ["itemtype" => "User", "items_id"=> 2]
        //     // ["items" => ["itemtype"=> "User", "items_id"=> 2] , ["itemtype"=> "Entity", "items_id"=> 0]]
        //     // "items" => [{"itemtype"=> "User", "items_id"=> 2}, {"itemtype"=> "Entity", "items_id"=> 0}]
        // ]);

        // return $usuarios;

        // $usuarios2 = Http::withHeaders([
        //     'Session-Token' => $session_token['session_token']
        // ])->get($usuarios[0]['links'][5]['href']);

        // $array = $usuarios->json(); 
        // // return   $usuarios[0]['links'][5]['href'];  
        // return $usuarios2;

        [$eps, $arl, $empresas] = $this->obtenerModelos();
        return view('pages.colaboradores.mostrar', compact('eps', 'arl', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exitCode = Artisan::call('cache:clear');
        $sesionToken = $this->colaboradores->initSesionGlpi();
        $consulta = Http::withHeaders([
            'Session-Token' => $sesionToken
        ])->get(env('API_URL', 'No hay URL').'computer/', [
            'range' => '0-1000',
            'get_hateoas' => false
        ]);
        $computadores = $consulta->json();
        $this->colaboradores->killSesionGlpi($sesionToken);

        $numComputadores=count($computadores);
        for ($i=0; $i < $numComputadores; $i++) { 
            if(!isset($computadores[$i]['users_id']) || $computadores[$i]['users_id'] == 0){
                unset($computadores[$i]);
            }
        }

        [$eps, $arl, $empresas] = $this->obtenerModelos();

        return view('pages.colaboradores.crear', compact('eps', 'arl', 'empresas', 'computadores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoColaborador = $request->all();

        $nuevoColaborador['nombre'] = ucwords(mb_strtolower($nuevoColaborador['nombre']));
        $nuevoColaborador['apellido'] = ucwords(mb_strtolower($nuevoColaborador['apellido']));
        $nuevoColaborador['descripcion'] = ucfirst(mb_strtolower($nuevoColaborador['descripcion']));
        // $nuevoColaborador['identificador'] = strtoupper($nuevoColaborador['identificador']);
        $nuevoColaborador['activo'] = 'Computador';
        $nuevoColaborador['codigo'] = ucfirst($nuevoColaborador['codigo']);
        $nuevoColaborador['id_tipo_persona'] = 2;
        $nuevoColaborador['id_usuario'] = auth()->user()->id_usuarios;

        // return $nuevoColaborador;

        $colaborador = Persona::create([
            'id_usuario' => $nuevoColaborador['id_usuario'],
            'id_tipo_persona' => $nuevoColaborador['id_tipo_persona'],
            'nombre' => $nuevoColaborador['nombre'],
            'apellido' => $nuevoColaborador['apellido'],
            'identificacion' => $nuevoColaborador['identificacion'],
            'id_eps' => $nuevoColaborador['id_eps'],
            'id_arl' => $nuevoColaborador['id_arl'],
            'tel_contacto' => $nuevoColaborador['tel_contacto'],
            'email' => $nuevoColaborador['email'],
            'id_empresa' => $nuevoColaborador['id_empresa'],
        ]);
        $colaborador->save();

        $mensajeActivo = $this->store3($nuevoColaborador, $colaborador->id_personas);
            $this->store4($nuevoColaborador, $colaborador->id_personas, null);
            $modal = [$colaborador->nombre.' '.$colaborador->apellido, $mensajeActivo];

        return redirect()->action([ColaboradorController::class, 'index']);
    }

    //Función que permite registrar un nuevo activo creado desde el modulo de visitantes
    public function store3($datos, $id_persona)
    {
        $activo = Activo::create([
            'activo' => $datos['activo'],
            'codigo' => $datos['codigo'],
            'id_usuario' => $datos['id_usuario'],
            'id_persona' => $id_persona,
        ]);
        $activo->save();
        return $activo->codigo;
    }

    //Función que permite hacer un registro de la entrada de un visitante al momento que se crea un nuevo visitante en la base de datos
    public function store4($datos, $id_persona, $id_vehiculo)
    {
        // if($datos['casoIngreso'] == 'casoVehiculo'){
        //     Registro::create([
        //         'id_persona' => $id_persona,
        //         'ingreso_persona' => date('Y-m-d H:i:s'),
        //         'ingreso_vehiculo' => date('Y-m-d H:i:s'),
        //         'id_vehiculo' => $id_vehiculo,
        //         'descripcion' => $datos['descripcion'],
        //         'id_empresa' => $datos['id_empresa'],
        //         'colaborador' => $datos['colaborador'],
        //         'id_usuario' => $datos['id_usuario'],
        //     ])->save(); 

        // } else if ($datos['casoIngreso'] == 'casoActivo'){
            Registro::create([
                'id_persona' => $id_persona,
                'ingreso_persona' => date('Y-m-d H:i:s'),
                'ingreso_activo' => date('Y-m-d H:i:s'),
                'descripcion' => $datos['descripcion'],
                'id_usuario' => $datos['id_usuario'],
            ])->save(); 
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

    /**
     * Función que permite traer la información de los modelos de la Eps, Arl y Empresa
     */
    public function obtenerModelos()
    {
        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        $empresas = $this->empresas->obtenerEmpresas();
        return [$eps, $arl, $empresas];
    }

    /**
     * Función que permite retornar en un formato JSON los datos de los colaboradores, arl, eps y empresa donde tengan un id en común.
     */
    public function informacionVisitantes()
    {
        return response()->json( $this->colaboradores->informacionPersonas(2));      
    } 

    /**
     * Función que recibe una petición de Ajax para obtener al colaborador propietario de un computador en específico directamente desde la API de GLPI.
     */
    public function getColaborador(Request $request)
    {
        $id= $request->input('colaborador');
        $sesionToken = $this->colaboradores->initSesionGlpi();
        $consulta = Http::withHeaders([
            'Session-Token' => $sesionToken
        ])->get(env('API_URL', 'No hay URL').'user/'.$id, [
            'get_hateoas' => false
        ]);
        $colaborador = $consulta->json();

        $consulta2 = Http::withHeaders([
            'Session-Token' => $sesionToken
        ])->get(env('API_URL', 'No hay URL').'userEmail/', [
            'range' => '0-1000',
            'get_hateoas' => false
        ]);
        $correos = $consulta2->json(); 
        $this->colaboradores->killSesionGlpi($sesionToken);

        foreach ($correos as $correo) {
            if ($correo['users_id'] == $colaborador['id']) {
                $colaborador['email'] = $correo['email'];
            }
        }
        
        return $colaborador;
    }
}