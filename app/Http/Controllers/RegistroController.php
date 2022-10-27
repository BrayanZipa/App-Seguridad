<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRegistros;
use App\Models\Arl;
use App\Models\Empresa;
use App\Models\Eps;
use App\Models\Persona;
use App\Models\Registro;
use App\Models\TipoPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\DataTables;
use App\Models\Activo;
use App\Models\PersonaVehiculo;
use App\Models\User;
use App\Models\Vehiculo;

class RegistroController extends Controller
{
    protected $usuarios;
    protected $registros;
    protected $tipoPersonas;
    protected $personas;
    protected $eps;
    protected $arl;
    protected $empresas;
    protected $activos;
    protected $vehiculos;
    protected $personasVehiculos;
    
    public function __construct(User $usuarios, Registro $registros, TipoPersona $tipoPersonas, Persona $personas, Eps $eps, Arl $arl, Empresa $empresas, Activo $activos, Vehiculo $vehiculos, PersonaVehiculo $personasVehiculos){
        $this->usuarios = $usuarios;
        $this->registros = $registros;
        $this->tipoPersonas = $tipoPersonas;
        $this->personas = $personas;
        $this->eps = $eps;
        $this->arl = $arl;
        $this->empresas = $empresas;
        $this->activos = $activos;
        $this->vehiculos = $vehiculos;
        $this->personasVehiculos = $personasVehiculos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->usuarios->asiganrRol(auth()->user());
        return view('pages.registros.mostrarRegistrosCompletos');
    }

    /**
     * Función que muestra una vista con todos los registros realizados en los cuales no se registra la salida de una persona, un vehículo o un activo.
     */
    public function registrosSinSalida()
    {
        $this->usuarios->asiganrRol(auth()->user());
        return view('pages.registros.mostrarRegistrosIncompletos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tipoPersona = null)
    {
        $exitCode = Artisan::call('cache:clear');
        $this->usuarios->asiganrRol(auth()->user());
        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        $tipoPersonas = $this->tipoPersonas->obtenerTipoPersona();
        $empresas = $this->empresas->obtenerEmpresas();
        return view('pages.registros.crear',  compact('eps', 'arl', 'tipoPersonas', 'empresas', 'tipoPersona'));
    }

    /**
     * Función que permite actualizar la información de una persona en caso de que se desee cambiar al momento de hacer un nuevo registro.
     */
    public function updatePersona(RequestRegistros $request, $id)
    {
        $persona = $request->all();
        $persona['nombre'] = ucwords(mb_strtolower($persona['nombre']));
        $persona['apellido'] = ucwords(mb_strtolower($persona['apellido']));
        $persona['descripcion'] = ucfirst(mb_strtolower($persona['descripcion']));
        Persona::findOrFail($id)->update($persona);

        if($persona['casoRegistro'] == 'visitante' || $persona['casoRegistro'] == 'visitanteActivo' || $persona['casoRegistro'] == 'conductor'){
            $persona['colaborador'] = ucwords(mb_strtolower($persona['colaborador']));
            if($persona['casoRegistro'] == 'visitanteActivo'){ 
                $persona['activo'] = ucwords(mb_strtolower($persona['activo']));
                $persona['codigo'] = ucfirst($persona['codigo']);

                if(!$this->activos->existeActivo($persona['codigo'], $id)){  
                    Activo::updateOrCreate(
                        ['id_persona' => $id],
                        [
                            'activo' => $persona['activo'],
                            'codigo' => $persona['codigo'],
                            'id_usuario' => auth()->user()->id_usuarios,
                        ]
                    );
                } else {
                    Activo::where('id_persona', $id)->update(['activo' => $persona['activo']]);
                }
            }
        } else if ($persona['casoRegistro'] == 'colaboradorConActivo'){
            $persona['codigo'] = ucfirst($persona['codigo']);
            $this->updateActivo($id, $persona['codigo']);
        }

        $datos = $this->store($persona);

        if($datos['casoRegistro'] == 'visitante' || $datos['casoRegistro'] == 'visitanteActivo'){
            $mensajes = ['visitante '.$datos['nombre'].' '.$datos['apellido']];
        } else if ($datos['casoRegistro'] == 'colaboradorConActivo' || $datos['casoRegistro'] == 'colaboradorSinActivo' || $datos['casoRegistro'] == 'colaboradorSinActivo2'){
            $mensajes = ['colaborador '.$datos['nombre'].' '.$datos['apellido']];
        } else if ($datos['casoRegistro'] == 'conductor'){ 
            $mensajes = ['conductor '.$datos['nombre'].' '.$datos['apellido']];
        }

        if($datos['id_vehiculo'] != null){ //ingreso de vehículo
            $mensajes[] = $this->vehiculos->obtenerVehiculo($datos['id_vehiculo'])->identificador;
            if($datos['casoRegistro'] == 'visitante' || $datos['casoRegistro'] == 'colaboradorSinActivo' || $datos['casoRegistro'] == 'colaboradorSinActivo2' || $datos['casoRegistro'] == 'conductor'){ //visitante y colaborador con vehículo y conductor
                $modal = ['registro_vehiculo', $mensajes];
            } else { //visitante o colaborador con activo y vehículo
                $mensajes[] = $datos['codigo_activo'];
                $modal = ['registro_vehiculoActivo', $mensajes];
            }
        } else if($datos['casoRegistro'] == 'visitanteActivo' || $datos['casoRegistro'] == 'colaboradorConActivo'){ //visitante o colaborador con activo
            $mensajes[] = $datos['codigo_activo'];
            $modal = ['registro_activo', $mensajes];
        } else { //visitante o colaborador
            $modal = ['registro_persona', $mensajes];
        }
        return redirect()->action([RegistroController::class, 'create'])->with($modal[0], $modal[1]); 
    }

    /**
     * Función que permite actualizar el código del activo de un colaborador en caso de que se cambie este código en GLPI al momento de hacer un nuevo registro.
     */
    public function updateActivo($idPersona, $codigoActivo)
    {
        if(!$this->activos->existeActivo($codigoActivo, $idPersona)){  
            $this->activos->verificarActivo($codigoActivo);   
            Activo::where('id_persona', $idPersona)->update(['codigo' => $codigoActivo]); 
        }  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($datos)
    {
        $datos['id_usuario'] = auth()->user()->id_usuarios;
        $datos['ingreso_persona'] = date('Y-m-d H:i:s');

        if(isset($datos['id_vehiculo'])){
            $datos['ingreso_vehiculo'] = date('Y-m-d H:i:s');    
        } else {
            $datos['id_vehiculo'] = null;
            $datos['ingreso_vehiculo'] = null;
        }

        if($datos['casoRegistro'] == 'visitanteActivo'){
            $datos['codigo_activo'] = $datos['codigo'];
            $datos['ingreso_activo'] = date('Y-m-d H:i:s');
        }
        else if($datos['casoRegistro'] == 'visitante' || $datos['casoRegistro'] == 'conductor'){
            $datos['codigo_activo'] = null;
            $datos['ingreso_activo'] = null;
        }
        else if($datos['casoRegistro'] == 'colaboradorSinActivo' || $datos['casoRegistro'] == 'colaboradorSinActivo2'){
            $datos['codigo_activo'] = null;
            $datos['ingreso_activo'] = null;
            $datos['empresa_visitada'] = null;
            $datos['colaborador'] = null;
            $datos['ficha'] = null;
        }
        else if($datos['casoRegistro'] == 'colaboradorConActivo'){
            $datos['codigo_activo'] = $datos['codigo'];
            $datos['ingreso_activo'] = date('Y-m-d H:i:s');
            $datos['empresa_visitada'] = null;
            $datos['colaborador'] = null;
            $datos['ficha'] = null;
        }

        Registro::create([
            'id_persona' => $datos['id_personas'],
            'ingreso_persona' => $datos['ingreso_persona'],
            'ingreso_vehiculo' => $datos['ingreso_vehiculo'],
            'id_vehiculo' => $datos['id_vehiculo'],
            'ingreso_activo' => $datos['ingreso_activo'],
            'codigo_activo' => $datos['codigo_activo'],
            'descripcion' => $datos['descripcion'],
            'empresa_visitada' => $datos['empresa_visitada'],
            'colaborador' => $datos['colaborador'],
            'ficha' => $datos['ficha'],
            'id_usuario' => $datos['id_usuario'],
        ])->save(); 

        return $datos;
    }

    /**
    * Función que recibe una petición Ajax para registrar la salida de un tipo de persona en la base de datos teniendo en cuenta si se registra la salida de un vehículo, un activo o solo la persona.
    */
    public function registrarSalida(Request $request, $id){
        $registro = Registro::findOrFail($id);
        $persona = Persona::findOrFail($registro->id_persona);
        $tiempoActual = date('Y-m-d H:i:s');
        $ingresoPersona = false;

        if ($request['registroSalida'] == 'salidaVehiculo'){
            $consulta = $this->consultarIngresoPersona($persona->id_personas);
            if ($consulta->exists()) {
                $personaSinSalida = $consulta->first();
                if ($persona->id_tipo_persona != 3 || ($persona->id_tipo_persona == 3 && $personaSinSalida->ingreso_activo == null && $personaSinSalida->salida_activo == null)) {
                    $personaSinSalida->salida_persona = $tiempoActual;
                    $personaSinSalida->id_usuario = auth()->user()->id_usuarios;
                    if($personaSinSalida->ingreso_activo != null) {
                        $personaSinSalida->salida_activo = $tiempoActual;
                    }
                    $personaSinSalida->save();
                    $ingresoPersona = true;
                }
            } 
        }

        $datos = ['salida_persona' => $tiempoActual, 'id_usuario' => auth()->user()->id_usuarios];
        if($request['registroSalida'] == 'salidaVehiculoActivo' || $request['registroSalida'] == 'salidaPersonaActivo'){
            if ($request['registroSalida'] == 'salidaVehiculoActivo') {
                $datos += ['salida_vehiculo' => $tiempoActual, 'salida_activo' => $tiempoActual];
            } else if($request['registroSalida'] == 'salidaPersonaActivo') {
                $datos += ['salida_activo' => $tiempoActual];
            } 
            if($request['codigo'] != null){
                $request['codigo'] = ucfirst($request['codigo']);
                $this->updateActivo($request['idPersona'], $request['codigo']);
                $descripcion = ' - Se realiza el cambio del activo '.$request['activoActual'].' y se asigna el '.$request['codigo']. ' por parte del área de tecnología.';
                $registro->descripcion .= $descripcion;
                $datos += ['codigo_activo_salida' => $request['codigo']];
            }

        } else if($request['registroSalida'] == 'salidaPersonaVehiculo'){
            $datos += ['salida_vehiculo' => $tiempoActual];

        } else if($request['registroSalida'] == 'salidaVehiculo'){
            $datos = ['salida_vehiculo' => $tiempoActual];
        }  
        $registro->update($datos);

        if($ingresoPersona){
            return response()->json(['tipoPersona' => $persona->id_tipo_persona, 'persona' => $persona->nombre.' '.$persona->apellido]);
        }
        return response()->json(['message' => 'Sin registro de ingreso de persona asociado']);
    }

    /**
     * Función que recibe una petición Ajax para registrar la salida de un activo al cual no se le había hecho el registro de salida anteriormente y de ser el caso también registra la salida de la persona asociada a este activo.
     */
    public function registrarSalidaActivo(Request $request, $id){
        $registro = Registro::findOrFail($id);
        $persona = Persona::findOrFail($registro->id_persona);
        $tiempoActual = date('Y-m-d H:i:s');
        $datos = ['salida_activo' => $tiempoActual];

        if($request['codigo'] != null){
            $request['codigo'] = ucfirst($request['codigo']);
            $this->updateActivo($request['idPersona'], $request['codigo']);
            $descripcion = ' - Se realiza el cambio del activo '.$request['activoActual'].' y se asigna el '.$request['codigo']. ' por parte del área de tecnología.';
            $registro->descripcion .= $descripcion;
            $datos += ['codigo_activo_salida' => $request['codigo']];
        }
        $registro->update($datos);

        $consulta = $this->consultarIngresoPersona($persona->id_personas);
        if ($consulta->exists()) {
            $personaSinSalida = $consulta->first();
            if ($persona->id_tipo_persona == 3) {
                $personaSinSalida->salida_persona = $tiempoActual;
                $personaSinSalida->id_usuario = auth()->user()->id_usuarios;
                $personaSinSalida->save();
                return response()->json(['id_persona' => $persona->id_personas, 'persona' => $persona->nombre.' '.$persona->apellido]);
            }
        } 
        return response()->json(['message' => 'Sin registro de ingreso de persona asociado']);
    }

    /**
     * Función con doble propósito, lo primero es que resive una petición Ajax para consultar si un determinado registro tiene el ingreso de un vehículo, pero no tiene registrado su salida y lo segundo es poder registrar la salida del vehículo previamente consultado.
     */
    public function verificarEstadoVehiculo(Request $request)
    {
        if ($request->isMethod('GET')) {
            $idPersona = $request->input('idPersona');
            $consulta = $this->consultarIngresoPersona($idPersona);
            if ($consulta->exists()) {
                $personaSinSalida = $consulta->first();
                if($personaSinSalida->ingreso_vehiculo != null){
                    $vehiculoIngresado = $this->vehiculos->obtenerVehiculo($personaSinSalida->id_vehiculo)->identificador;
                    return response()->json(['vehiculo_ingresado' => $vehiculoIngresado, 'registro' => $personaSinSalida->id_registros]);
                }
            }

            try {
                $consultaVehiculo = Registro::where('id_persona', $idPersona)->whereNotNull('ingreso_vehiculo')->whereNull('salida_vehiculo')->latest('ingreso_vehiculo');
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
            }
            if ($consultaVehiculo->exists()) {
                $vehiculoSinSalida = $consultaVehiculo->first();
                $vehiculoPermutado = $this->vehiculos->obtenerVehiculo($vehiculoSinSalida->id_vehiculo)->identificador;
                return response()->json(['vehiculo_pernoctado' => $vehiculoPermutado, 'registro' => $vehiculoSinSalida->id_registros]);
            }
            return response()->json(['message' => 'Sin registro de vehículo asociado']);

        } else if ($request->isMethod('PUT')) {
            $idRegistro = $request->input('idRegistro');
            $registro = Registro::findOrFail($idRegistro);
            $registro->salida_vehiculo = date('Y-m-d H:i:s');
            $registro->save();
        }
    }

    /**
     * Función que permite retornar el último registro de una persona a la cual no se le ha registrado la salida
     */
    public function consultarIngresoPersona($idPersona)
    {
        try {
            $consulta = Registro::where('id_persona', $idPersona)->whereNull('salida_persona')->latest('ingreso_persona');
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $consulta;
    }

    /**
    * Función que recibe una petición Ajax para obtener la información de un grupo de personas en específico (Visitantes, Colaboradores, Colaboradores con activo, Conductores) las cuales no tengan registros con el campo salida_persona con valor nulo en la tabla se_registros.
    */
    public function getPersonas(Request $request){
        $tipoPersona = $request->input('tipoPersona');
        $personasRegistradas = $this->registros->registrosNulos();
        $personas = $this->personas->obtenerPersonas($tipoPersona);

        foreach ($personasRegistradas as $personaRegistrada) {
            foreach ($personas as $indice => $persona) {
                if($persona->id_personas == $personaRegistrada->id_persona){
                    unset($personas[$indice]);
                }     
            }
        }
        return response()->json($personas);
    }

    /**
     * Función que recibe una petición Ajax con el id de una persona con el cuál se realiza una búsqueda y se retorna la información que esta persona tenga asociada.
     */
    public function getPersona(Request $request){
        $id = $request->input('persona');
        return $this->personas->obtenerInformacionPersona($id);
    }

    /**
     * Función que recibe una petición Ajax con el id de una persona con el cuál se realiza una búsqueda y se retorna una lista con todos los vehículos que esta persona tenga asociados.
     */
    public function getVehiculos(Request $request){
        $id = $request->input('persona');
        try {
            $vehiculosSinSalida = Registro::whereNotNull('ingreso_vehiculo')->whereNull('salida_vehiculo')->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        $vehiculos = $this->personasVehiculos->informacionVehiculos($id);

        foreach ($vehiculosSinSalida as $vehiculoSinSalida) {
            foreach ($vehiculos as $indice => $vehiculo) {
                if($vehiculo->id_vehiculos == $vehiculoSinSalida->id_vehiculo){
                    unset($vehiculos[$indice]);
                }
            }
        }
        return response()->json($vehiculos);
    }

    /**
     * Función que recibe una petición Ajax con el id de una persona con el cuál se realiza una búsqueda en los registros para retornar el último registro donde esa persona haya ingresado con un vehículo y se haya registrado la salida de la persona, pero no del vehículo.
     */
    public function utimoRegistroVehiculo(Request $request){
        $id = $request->input('persona');
        try {
            $registro = Registro::select('se_registros.ingreso_vehiculo', 'vehiculos.identificador')
            ->leftjoin('se_vehiculos AS vehiculos', 'se_registros.id_vehiculo', '=', 'vehiculos.id_vehiculos')
            ->where('id_persona', $id)->whereNotNull('salida_persona')->whereNotNull('ingreso_vehiculo')->whereNull('salida_vehiculo')->latest('ingreso_vehiculo')->first();
            if($registro == null){
                $registro = response()->json(['message' => 'La persona no tiene registros con un vehículo sin salida']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $registro; 
    }

    /**
     * Función que recibe una petición Ajax con el id de un colaborador con el cuál se realiza una búsqueda en los registros para retornar el último registro donde esa persona haya ingresado un activo y se haya registrado la salida de la persona, pero no del activo.
     */
    public function utimoRegistroActivo(Request $request){
        $id = $request->input('persona');
        try {
            $registro = Registro::select('se_registros.*')
            ->where('id_persona', $id)->whereNotNull('salida_persona')->whereNotNull('ingreso_activo')->whereNull('salida_activo')->latest('ingreso_activo')->first();
            if($registro == null){
                $registro = response()->json(['message' => 'La persona no tiene registros con un activo sin salida']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $registro; 
    }

    /**
     * Función que permite retornar todos los registros de la tabla se_registros asociados a las personas, vehículos y activos donde tengan un id en común y tengan un registro de salida de la persona.
     */
    public function informacionRegistros(Request $request){
        if($request->ajax()){
            $registros = $this->registros->registrosNoNulos();
            return DataTables::of($registros)->make(true);
        }     
    }

    /**
     * Función que permite retornar todos los registros de la tabla se_registros asociados a las personas, vehículos y activos donde tengan un id en común y no tengan un registro de salida de la persona.
     */
    public function informacionRegistrosSinSalida(Request $request){
        if($request->ajax()){
            $registros = $this->registros->registrosNulos();
            return DataTables::of($registros)->make(true);
        }
    }

    /**
     * Función que permite retornar todos los registros de la tabla se_registros asociados a las personas y vehículos donde tengan un id en común y tengan un registro de salida de la persona, pero no de la salida del vehículo.
     */
    public function informacionRegistrosVehiculos(Request $request){
        if($request->ajax()){
            $registros = $this->registros->informacionRegistrosVehiculos();
            return DataTables::of($registros)->make(true);
        }
    }

    /**
     * Función que permite retornar todos los registros de la tabla se_registros asociados a las personas y activos donde tengan un id en común y tengan un registro de salida de la persona, pero no de la salida del activo.
     */
    public function informacionRegistrosActivos(Request $request){
        if($request->ajax()){
            $registros = $this->registros->informacionRegistrosActivos();
            return DataTables::of($registros)->make(true);
        }
    }

    /**
     * Función que permite retornar todos los registros de la tabla se_registros de una persona en especifico filtrados por año y por mes.
     */
    public function registrosPorPersona(Request $request)
    {
        $id = $request->input('persona');
        $anio = $request->input('anio');
        $mes = $request->input('mes');   
        try {
            $consulta = Registro::select('se_registros.ingreso_persona', 'se_registros.salida_persona', 'se_registros.codigo_activo', 'vehiculos.identificador')
            ->leftjoin('se_vehiculos AS vehiculos', 'se_registros.id_vehiculo', '=', 'vehiculos.id_vehiculos')
            ->where('id_persona', $id)->whereNotNull('salida_persona')->whereYear('ingreso_persona', $anio)->whereMonth('ingreso_persona', $mes)->latest('ingreso_persona');
            
            $registros = $consulta->get();
            $totalRegistros = $consulta->count();

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return response()->json(['registros' => $registros, 'totalRegistros' =>  $totalRegistros]);
    }
}