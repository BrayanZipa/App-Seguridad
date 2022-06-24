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
    protected $activos;

    public function __construct(Persona $colaboradores, Eps $eps, Arl $arl, TipoVehiculo $tipoVehiculos, MarcaVehiculo $marcaVehiculos, Empresa $empresas, Activo $activos){
        $this->colaboradores = $colaboradores;
        $this->eps = $eps;
        $this->arl = $arl;
        $this->tipoVehiculos = $tipoVehiculos;
        $this->marcaVehiculos = $marcaVehiculos;
        $this->empresas = $empresas;
        $this->activos = $activos;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitCode = Artisan::call('cache:clear');
        [$eps, $arl, $empresas] = $this->obtenerModelos();
        return view('pages.colaboradores.mostrar', compact('eps', 'arl', 'empresas'));
    }

    public function index2()
    {
        $exitCode = Artisan::call('cache:clear');
        [$eps, $arl, $empresas] = $this->obtenerModelos();
        return view('pages.colaboradores.mostrar2', compact('eps', 'arl', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exitCode = Artisan::call('cache:clear');
        $personas = $this->colaboradores->obtenerPersonas(1);
        $colaboradoresActivo = $this->colaboradores->obtenerPersonas(3);
        $listaColaboradores = $this->getColaboradores();

        foreach ($colaboradoresActivo as $colaboradorActivo) {
            foreach ($listaColaboradores as $indice => $colaborador) {
                if($colaborador['registration_number'] == $colaboradorActivo->identificacion){
                    unset($listaColaboradores[$indice]);
                }     
            }
        }
        // return count($listaColaboradores);
        
        [$eps, $arl, $tipoVehiculos, $marcaVehiculos, $empresas] = $this->obtenerModelos2();

        return view('pages.colaboradores.crear', compact('eps', 'arl', 'tipoVehiculos', 'marcaVehiculos', 'empresas', 'listaColaboradores', 'personas'));
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
        $nuevoColaborador['id_usuario'] = auth()->user()->id_usuarios;
        if(array_key_exists('casoIngreso', $nuevoColaborador)){
            $nuevoColaborador['id_tipo_persona'] = 3;
        } else{
            $nuevoColaborador['id_tipo_persona'] = 2;
        }

        $colaborador = Persona::updateOrCreate(
            ['identificacion' => $nuevoColaborador['identificacion']],
            [
                'id_usuario' => $nuevoColaborador['id_usuario'],
                'id_tipo_persona' => $nuevoColaborador['id_tipo_persona'],
                'nombre' => $nuevoColaborador['nombre'],
                'apellido' => $nuevoColaborador['apellido'],
                'id_eps' => $nuevoColaborador['id_eps'],
                'id_arl' => $nuevoColaborador['id_arl'],
                'tel_contacto' => $nuevoColaborador['tel_contacto'],
                'email' => $nuevoColaborador['email'],
                'id_empresa' => $nuevoColaborador['id_empresa']
            ]
        );

        if(array_key_exists('casoIngreso', $nuevoColaborador)){
            if ($nuevoColaborador['casoIngreso'] == 'conActivoVehiculo'){
                [$mensajeVehiculo, $id_vehiculo] = $this->store2($nuevoColaborador, $colaborador->id_personas);
                $mensajeActivo = $this->store3($nuevoColaborador, $colaborador->id_personas);
                $this->store4($nuevoColaborador, $colaborador->id_personas, $id_vehiculo, $mensajeActivo);
                $modal = [$colaborador->nombre.' '.$colaborador->apellido, $mensajeVehiculo, $mensajeActivo];

                if ($colaborador->wasChanged()) {
                    return redirect()->action([ColaboradorController::class, 'create'])->with('editar_colaborador_vehiculoActivo', $modal);
                } else {
                    return redirect()->action([ColaboradorController::class, 'create'])->with('crear_colaborador_vehiculoActivo', $modal);
                }
            } else{
                $mensajeActivo = $this->store3($nuevoColaborador, $colaborador->id_personas);
                $this->store4($nuevoColaborador, $colaborador->id_personas, null, $mensajeActivo);
                $modal = [$colaborador->nombre.' '.$colaborador->apellido, $mensajeActivo];
                
                if ($colaborador->wasChanged()) {
                    return redirect()->action([ColaboradorController::class, 'create'])->with('editar_colaborador_activo', $modal);
                } else {
                    return redirect()->action([ColaboradorController::class, 'create'])->with('crear_colaborador_activo', $modal);
                }
            }
        } else if (array_key_exists('casoIngreso2', $nuevoColaborador)){
            if($nuevoColaborador['casoIngreso2'] == 'sinActivoVehiculo'){
                [$mensajeVehiculo, $id_vehiculo] = $this->store2($nuevoColaborador, $colaborador->id_personas);
                $this->store4($nuevoColaborador, $colaborador->id_personas, $id_vehiculo, null);
                $modal = [$colaborador->nombre.' '.$colaborador->apellido, $mensajeVehiculo];

                if ($colaborador->wasChanged()) {
                    return redirect()->action([ColaboradorController::class, 'create'])->with('editar_colaborador_vehiculo', $modal);
                } else {
                    return redirect()->action([ColaboradorController::class, 'create'])->with('crear_colaborador_vehiculo', $modal);
                }
            } else if ($nuevoColaborador['casoIngreso2'] == 'colaboradorSinActivo'){
                $this->store4($nuevoColaborador, $colaborador->id_personas, null, null);
                
                if ($colaborador->wasChanged()) {
                    return redirect()->action([ColaboradorController::class, 'create'])->with('editar_colaborador', $colaborador->nombre.' '.$colaborador->apellido);
                } else {
                    return redirect()->action([ColaboradorController::class, 'create'])->with('crear_colaborador', $colaborador->nombre.' '.$colaborador->apellido);
                }
            }       
        }   
    }

    /**
     * Función que permite registrar un nuevo vehículo creado desde el módulo de colaboradores
     */
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

        $datos['identificador'] = strtoupper($datos['identificador']);
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

    /**
     * Función que permite registrar un nuevo activo creado desde el módulo de colaboradores
     */
    public function store3($datos, $id_persona)
    {
        $datos['codigo'] = ucfirst($datos['codigo']);
        $this->activos->verificarActivo($datos['codigo']); 

        $activo = Activo::updateOrCreate(
            ['id_persona' => $id_persona],
            [
                'activo' => 'Computador',
                'codigo' => $datos['codigo'],
                'id_usuario' => $datos['id_usuario'],
            ]
        );
        return $activo->codigo;
    }

    /**
     * Función que permite hacer un registro de la entrada de un colaborador al momento que se crea un nuevo colaborador en la base de datos
     */
    public function store4($datos, $id_persona, $id_vehiculo, $activo)
    {
        if(array_key_exists('casoIngreso', $datos)){
            if ($datos['casoIngreso'] == 'conActivoVehiculo'){
                Registro::create([
                    'id_persona' => $id_persona,
                    'ingreso_persona' => date('Y-m-d H:i:s'),
                    'ingreso_vehiculo' => date('Y-m-d H:i:s'),
                    'id_vehiculo' => $id_vehiculo,
                    'ingreso_activo' => date('Y-m-d H:i:s'),
                    'codigo_activo' => $activo,
                    'descripcion' => $datos['descripcion'],
                    'id_usuario' => $datos['id_usuario'],
                    ])->save();  
            } else {
                Registro::create([
                    'id_persona' => $id_persona,
                    'ingreso_persona' => date('Y-m-d H:i:s'),
                    'ingreso_activo' => date('Y-m-d H:i:s'),
                    'codigo_activo' => $activo,
                    'descripcion' => $datos['descripcion'],
                    'id_usuario' => $datos['id_usuario'],
                ])->save(); 
            }
        } else if (array_key_exists('casoIngreso2', $datos)){
            if ($datos['casoIngreso2'] == 'sinActivoVehiculo'){
                Registro::create([
                    'id_persona' => $id_persona,
                    'ingreso_persona' => date('Y-m-d H:i:s'),
                    'ingreso_vehiculo' => date('Y-m-d H:i:s'),
                    'id_vehiculo' => $id_vehiculo,
                    'descripcion' => $datos['descripcion'],
                    'id_usuario' => $datos['id_usuario'],
                ])->save();
            } else if($datos['casoIngreso2'] == 'colaboradorSinActivo'){
                Registro::create([
                    'id_persona' => $id_persona,
                    'ingreso_persona' => date('Y-m-d H:i:s'),
                    'descripcion' => $datos['descripcion'],
                    'id_usuario' => $datos['id_usuario'],
                ])->save(); 
            }
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestColaborador $request, $id)
    {
        $colaborador = $request->all();
        $colaborador['nombre'] = ucwords(mb_strtolower($colaborador['nombre']));
        $colaborador['apellido'] = ucwords(mb_strtolower($colaborador['apellido']));
        Persona::findOrFail($id)->update($colaborador);

        if(isset($colaborador['codigo'])){ //saber si existe
            $colaborador['codigo'] = ucfirst($colaborador['codigo']);
            if($this->activos->existeActivo($colaborador['codigo'], $id)){  
                return redirect()->action([ColaboradorController::class, 'index'])->with('editar_colaborador2', $colaborador['nombre']." ".$colaborador['apellido']);
            } else {
                $this->activos->verificarActivo($colaborador['codigo']);   
                Activo::where('id_persona', $id)->update(['codigo' => $colaborador['codigo']]);
                $modal = [$colaborador['nombre']." ".$colaborador['apellido'], $colaborador['codigo']];
                return redirect()->action([ColaboradorController::class, 'index'])->with('editar_colaborador_activo2', $modal);
            }    
        } 
        return redirect()->action([ColaboradorController::class, 'index2'])->with('editar_colaborador2', $colaborador['nombre']." ".$colaborador['apellido']); 
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $this->activos->existeActivoEliminar($id);
        $colaborador = $this->colaboradores->obtenerPersona($id);
        if($colaborador->foto == null){
            $colaborador->foto = 'sinfoto';
        } 
        $colaborador->id_tipo_persona = 1;
        $colaborador->save();
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
     * Función que permite traer la información de los modelos de la Eps, Arl, TipoVehiculo, MarcaVehiculo y Empresa
     */
    public function obtenerModelos2() 
    {
        [$eps, $arl, $empresas] = $this->obtenerModelos();
        $tipoVehiculos = $this->tipoVehiculos->obtenerTipoVehiculos();
        $marcaVehiculos = $this->marcaVehiculos->obtenerMarcaVehiculos();

        return [$eps, $arl, $tipoVehiculos, $marcaVehiculos, $empresas];
    }

    /**
     * Función que recibe una petición Ajax con un parámetro que trae el tipo de colaborador, retorna en un formato JSON los datos de los colaboradores, arl, eps, empresa y activo donde tengan un id en común.
     */
    public function informacionColaboradores(Request $request)
    {
        $tipoPersona = $request->input('tipoPersona');
        return response()->json( $this->colaboradores->informacionPersonas($tipoPersona));      
    }

    /**
     * Función que recibe una petición de Ajax para obtener los datos de una persona de tipo visitante que este creada en la tabla se_personas.
     */
    public function getPersona(Request $request)
    {
        $id = $request->input('persona');
        return $this->colaboradores->obtenerPersona($id);
    }

    /**
     * Función que que hace una consulta al API de GLPI y trae todos los colaboradores con un activo asigando en el sistema y retorna esta información en una lista.
     */
    public function getColaboradores()
    {
        $sesionToken = $this->colaboradores->initSesionGlpi();
        try {
            $consulta = Http::withHeaders([
                'Session-Token' => $sesionToken
            ])->get(env('API_URL', 'No hay URL').'user/', [
                'range' => '0-1000',
                'get_hateoas' => false
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de los activos desde GLPI'], 500);
        }      
        $listaColaboradores = $consulta->json();
        $this->colaboradores->killSesionGlpi($sesionToken);

        $numColaboradores=count($listaColaboradores);
        for ($i=0; $i < $numColaboradores; $i++) { 
            if(!isset($listaColaboradores[$i]['realname']) || $listaColaboradores[$i]['registration_number'] == ''){
                unset($listaColaboradores[$i]);
            }
        }
        return $listaColaboradores;
    }

    /**
     * Función que recibe una petición de Ajax para obtener al colaborador propietario de un computador en específico directamente desde la API de GLPI.
     */
    public function getColaborador(Request $request)
    {
        $id = $request->input('colaborador');
        $sesionToken = $this->colaboradores->initSesionGlpi();
        try {
            $consulta = Http::withHeaders([
                'Session-Token' => $sesionToken
            ])->get(env('API_URL', 'No hay URL').'user/'.$id, [
                'get_hateoas' => false
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información del colaborador seleccionado desde GLPI'], 500);
        }
        $colaborador = $consulta->json();
        $this->colaboradores->killSesionGlpi($sesionToken);

        $colaborador['email'] = $this->getEmail($colaborador['id']);
        return $colaborador;
    }


    /**
     * Función que permite buscar y retornar el Email de un colaborador desde la API de GLPI por medio de su id.
     */
    public function getEmail($idColaborador)
    {
        $sesionToken = $this->colaboradores->initSesionGlpi();
        try {     
            $consulta = Http::withHeaders([
                'Session-Token' => $sesionToken
            ])->get(env('API_URL', 'No hay URL').'userEmail/', [
                'range' => '0-1000',
                'get_hateoas' => false
            ]); 
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información del Email del colaborador desde GLPI'], 500);
        }
        $correos = $consulta->json();
        $this->colaboradores->killSesionGlpi($sesionToken);

        foreach ($correos as $correo) {
            if ($correo['users_id'] == $idColaborador) {
                $email = $correo['email'];
            }
        }
        return $email;
    }

    /**
     * Función que que hace una consulta al API de GLPI y trae todos los computadores creados en el sistema y los envia a  una vista con el formulario de creación de colaborador.
     */
    public function getComputadores()
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

        [$eps, $arl, $tipoVehiculos, $marcaVehiculos, $empresas] = $this->obtenerModelos2();
        return view('pages.colaboradores.prueba', compact('eps', 'arl', 'tipoVehiculos', 'marcaVehiculos', 'empresas', 'computadores'));
    }

    /**
     * Función que recibe una petición de Ajax para obtener al computador de un colaborador en específico directamente desde la API de GLPI.
     */
    public function getComputador(Request $request)
    {
        $id = $request->input('colaborador');
        $sesionToken = $this->colaboradores->initSesionGlpi();
        try {
            $consulta = Http::withHeaders([
                'Session-Token' => $sesionToken
            ])->get(env('API_URL', 'No hay URL').'computer/', [
                'range' => '0-1000',
                'get_hateoas' => false
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información del activo desde GLPI'], 500);
        }
        $computadores = $consulta->json();
        $this->colaboradores->killSesionGlpi($sesionToken);

        $numComputadores=count($computadores);
        for ($i=0; $i < $numComputadores; $i++) { 
            if($computadores[$i]['users_id'] == $id){
                $computador = $computadores[$i];
            }
        }
        if(!isset($computador)){
            $computador = ['error' =>  'Sin activo asignado para este ususario'];
        }    

        return $computador;
    }

    /**
     * Función que recibe una petición de Ajax para obtener a un colaborador propietario de un computador en específico desde la API de GLPI por medio de su identificación
     */
    public function getColaboradorIdentificacion(Request $request)
    {
        $identificacion = $request->input('colaborador');
        $colaboradores = $this->getColaboradores();
        foreach ($colaboradores as $colaborador) {
            if($colaborador['registration_number'] == $identificacion){
                $response = $colaborador;
            }
        }

        if(!isset($response)){
            $response =  ['error' => 'El colaborador buscado no se encuentra registrado en el sistema GLPI'];
        } else {
            $response['email'] = $this->getEmail($response['id']);
        } 

        return $response;
    }
}