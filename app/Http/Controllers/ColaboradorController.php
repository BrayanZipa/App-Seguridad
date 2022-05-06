<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestColaborador;
use App\Models\Activo;
use App\Models\Arl;
use App\Models\Empresa;
use App\Models\Eps;
use App\Models\MarcaVehiculo;
use App\Models\Persona;
use App\Models\PersonaVehiculo;
use App\Models\Registro;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ColaboradorController extends Controller
{
    protected $colaboradores;
    protected $eps;
    protected $arl;
    protected $tipoVehiculos;
    protected $marcaVehiculos;
    protected $empresas;

    public function __construct(Persona $colaboradores, Eps $eps, Arl $arl, TipoVehiculo $tipoVehiculos, MarcaVehiculo $marcaVehiculos, Empresa $empresas){
        $this->colaboradores = $colaboradores;
        $this->eps = $eps;
        $this->arl = $arl;
        $this->tipoVehiculos = $tipoVehiculos;
        $this->marcaVehiculos = $marcaVehiculos;
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

        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        $empresas = $this->empresas->obtenerEmpresas();
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
        try {
            $consulta = Http::withHeaders([
                'Session-Token' => $sesionToken
            ])->get(env('API_URL', 'No hay URL').'computer/', [
                'range' => '0-1000',
                'get_hateoas' => false
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de los activos desde GLPI'], 500);
        }      
        $computadores = $consulta->json();
        $this->colaboradores->killSesionGlpi($sesionToken);

        $numComputadores=count($computadores);
        for ($i=0; $i < $numComputadores; $i++) { 
            if(!isset($computadores[$i]['users_id']) || $computadores[$i]['users_id'] == 0){
                unset($computadores[$i]);
            }
        }

        [$eps, $arl, $tipoVehiculos, $marcaVehiculos, $empresas] = $this->obtenerModelos();

        return view('pages.colaboradores.crear', compact('eps', 'arl', 'tipoVehiculos', 'marcaVehiculos', 'empresas', 'computadores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestColaborador $request)
    {
        $nuevoColaborador = $request->all();
        
        $nuevoColaborador['nombre'] = ucwords(mb_strtolower($nuevoColaborador['nombre']));
        $nuevoColaborador['apellido'] = ucwords(mb_strtolower($nuevoColaborador['apellido']));
        $nuevoColaborador['descripcion'] = ucfirst(mb_strtolower($nuevoColaborador['descripcion']));
        $nuevoColaborador['identificador'] = strtoupper($nuevoColaborador['identificador']);
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

        if(array_key_exists('casoIngreso', $nuevoColaborador)){
            if ($nuevoColaborador['casoIngreso'] == 'casoVehiculoActivo'){
                [$mensajeVehiculo, $id_vehiculo] = $this->store2($nuevoColaborador, $colaborador->id_personas);
                $mensajeActivo = $this->store3($nuevoColaborador, $colaborador->id_personas);
                $this->store4($nuevoColaborador, $colaborador->id_personas, $id_vehiculo);
                $modal = [$colaborador->nombre.' '.$colaborador->apellido, $mensajeVehiculo, $mensajeActivo];
                return redirect()->action([ColaboradorController::class, 'create'])->with('crear_colaborador_vehiculoActivo', $modal);
            } else{
                $mensajeActivo = $this->store3($nuevoColaborador, $colaborador->id_personas);
                $this->store4($nuevoColaborador, $colaborador->id_personas, null);
                $modal = [$colaborador->nombre.' '.$colaborador->apellido, $mensajeActivo];
                return redirect()->action([ColaboradorController::class, 'create'])->with('crear_colaborador', $modal);
            }
        } else if (array_key_exists('casoIngreso2', $nuevoColaborador)){
            [$mensajeVehiculo, $id_vehiculo] = $this->store2($nuevoColaborador, $colaborador->id_personas);
            $this->store4($nuevoColaborador, $colaborador->id_personas, $id_vehiculo);
            $modal = [$colaborador->nombre.' '.$colaborador->apellido, $mensajeVehiculo];
            return redirect()->action([ColaboradorController::class, 'create'])->with('crear_colaborador_vehiculo', $modal);
        }

        
    }

    //Función que permite registrar un nuevo vehículo creado desde el modulo de visitantes
    public function store2($datos, $id_persona)
    {
        if(!isset($datos['foto_vehiculo'])){ //saber si es null
            $url = null;
        } else {
            $img = $datos['foto_vehiculo'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $foto = base64_decode($img);
            $filename = 'vehiculos/'. $id_persona. '_'. $datos['identificador']. '_'.date('Y-m-d'). '.png';
            $ruta = storage_path() . '\app\public/' .  $filename;
            Image::make($foto)->resize(600, 500)->save($ruta);
            $url = Storage::url($filename);
        }
    
        if(!isset($datos['id_marca_vehiculo'])){ //saber si existe
            $datos['id_marca_vehiculo'] = null;
        }
    
        $vehiculo = Vehiculo::create([
            'identificador' => $datos['identificador'],
            'id_tipo_vehiculo' => $datos['id_tipo_vehiculo'],
            'id_marca_vehiculo' => $datos['id_marca_vehiculo'],
            'foto_vehiculo' => $url,
            'id_usuario' => $datos['id_usuario'],
        ]);
        $vehiculo->save();
    
        PersonaVehiculo::create([
            'id_vehiculo' => $vehiculo->id_vehiculos,
            'id_persona' => $id_persona,
        ])->save();
    
        return [$vehiculo->identificador, $vehiculo->id_vehiculos];
    }

    //Función que permite registrar un nuevo activo creado desde el modulo de colaboradores
    public function store3($datos, $id_persona)
    {
        $datos['codigo'] = ucfirst($datos['codigo']);

        $activo = Activo::create([
            'activo' => 'Computador',
            'codigo' => $datos['codigo'],
            'id_usuario' => $datos['id_usuario'],
            'id_persona' => $id_persona,
        ]);
        $activo->save();
        return $activo->codigo;
    }

    //Función que permite hacer un registro de la entrada de un colaborador al momento que se crea un nuevo colaborador en la base de datos
    public function store4($datos, $id_persona, $id_vehiculo)
    {
        if(array_key_exists('casoIngreso', $datos)){
            if ($datos['casoIngreso'] == 'casoVehiculoActivo'){
                Registro::create([
                    'id_persona' => $id_persona,
                    'ingreso_persona' => date('Y-m-d H:i:s'),
                    'ingreso_vehiculo' => date('Y-m-d H:i:s'),
                    'id_vehiculo' => $id_vehiculo,
                    'ingreso_activo' => date('Y-m-d H:i:s'),
                    'descripcion' => $datos['descripcion'],
                    'id_usuario' => $datos['id_usuario'],
                    ])->save();  
    
            } else {
                Registro::create([
                    'id_persona' => $id_persona,
                    'ingreso_persona' => date('Y-m-d H:i:s'),
                    'ingreso_activo' => date('Y-m-d H:i:s'),
                    'descripcion' => $datos['descripcion'],
                    'id_usuario' => $datos['id_usuario'],
                ])->save(); 
            }
        } else if (array_key_exists('casoIngreso2', $datos)){
            Registro::create([
                'id_persona' => $id_persona,
                'ingreso_persona' => date('Y-m-d H:i:s'),
                'ingreso_vehiculo' => date('Y-m-d H:i:s'),
                'id_vehiculo' => $id_vehiculo,
                'descripcion' => $datos['descripcion'],
                'id_usuario' => $datos['id_usuario'],
            ])->save(); 
        }  
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
        $colaborador = $request->all();
        return $colaborador;
        // $colaborador['nombre'] = ucwords(mb_strtolower($colaborador['nombre']));
        // $colaborador['apellido'] = ucwords(mb_strtolower($colaborador['apellido']));
        // // $visitante = Visitante::find($id)->fill($request->all())->save();
        // Persona::findOrFail($id)->update($colaborador);
        // return redirect()->action([ColaboradorController::class, 'index'])->with('editar_visitante', $colaborador['nombre']." ".$colaborador['apellido']);
    }

    /**
     * Función que permite traer la información de los modelos de la Eps, Arl y Empresa
     */
    public function obtenerModelos()
    {
        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        $tipoVehiculos = $this->tipoVehiculos->obtenerTipoVehiculos();
        $marcaVehiculos = $this->marcaVehiculos->obtenerMarcaVehiculos();
        $empresas = $this->empresas->obtenerEmpresas();

        return [$eps, $arl, $tipoVehiculos, $marcaVehiculos, $empresas];
    }

    /**
     * Función que permite retornar en un formato JSON los datos de los colaboradores, arl, eps y empresa donde tengan un id en común.
     */
    public function informacionColaboradores()
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
        try {
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
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información del colaborador seleccionado desde GLPI'], 500);
        }
        $this->colaboradores->killSesionGlpi($sesionToken);

        foreach ($correos as $correo) {
            if ($correo['users_id'] == $colaborador['id']) {
                $colaborador['email'] = $correo['email'];
            }
        }
        
        return $colaborador;
    }
}