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
use App\Models\Vehiculo;

class RegistroController extends Controller
{
    protected $registros;
    protected $tipoPersonas;
    protected $personas;
    protected $eps;
    protected $arl;
    protected $empresas;
    protected $activos;
    protected $vehiculos;
    
    public function __construct(Registro $registros, TipoPersona $tipoPersonas, Persona $personas, Eps $eps, Arl $arl, Empresa $empresas, Activo $activos, Vehiculo $vehiculos){
        $this->registros = $registros;
        $this->tipoPersonas = $tipoPersonas;
        $this->personas = $personas;
        $this->eps = $eps;
        $this->arl = $arl;
        $this->empresas = $empresas;
        $this->activos = $activos;
        $this->vehiculos = $vehiculos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $exitCode = Artisan::call('cache:clear');
        return view('pages.registros.mostrar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exitCode = Artisan::call('cache:clear');
        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        $tipoPersonas = $this->tipoPersonas->obtenerTipoPersona();
        $empresas = $this->empresas->obtenerEmpresas();
        return view('pages.registros.crear',  compact('eps', 'arl', 'tipoPersonas', 'empresas'));
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
                }
            }
        } else if ($persona['casoRegistro'] == 'colaboradorConActivo'){
            $persona['codigo'] = ucfirst($persona['codigo']);
            if(!$this->activos->existeActivo($persona['codigo'], $id)){  
                $this->activos->verificarActivo($persona['codigo']);   
                Activo::where('id_persona', $id)->update(['codigo' => $persona['codigo']]); 
            }    
        }

        $datos = $this->store($persona);

        if($datos['casoRegistro'] == 'visitante' || $datos['casoRegistro'] == 'visitanteActivo'){
            $mensajes = ['visitante '.$datos['nombre'].' '.$datos['apellido']];
        } else if ($datos['casoRegistro'] == 'colaboradorConActivo' || $datos['casoRegistro'] == 'colaboradorSinActivo'){
            $mensajes = ['colaborador '.$datos['nombre'].' '.$datos['apellido']];
        } else if ($datos['casoRegistro'] == 'conductor'){ 
            $mensajes = ['conductor '.$datos['nombre'].' '.$datos['apellido']];
        }

        if($datos['id_vehiculo'] != null){ //ingreso de vehículo
            $mensajes[] = $this->vehiculos->obtenerVehiculo($datos['id_vehiculo'])->identificador;
            if($datos['casoRegistro'] == 'visitante' || $datos['casoRegistro'] == 'colaboradorSinActivo' || $datos['casoRegistro'] == 'conductor'){ //visitante y colaborador con vehículo y conductor
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
            $datos['codigo_activo'] = $datos['activo'].' '.$datos['codigo'];
            $datos['ingreso_activo'] = date('Y-m-d H:i:s');
        }
        else if($datos['casoRegistro'] == 'visitante' || $datos['casoRegistro'] == 'conductor'){
            $datos['codigo_activo'] = null;
            $datos['ingreso_activo'] = null;
        }
        else if($datos['casoRegistro'] == 'colaboradorSinActivo'){
            $datos['codigo_activo'] = null;
            $datos['ingreso_activo'] = null;
            $datos['empresa_visitada'] = null;
            $datos['colaborador'] = null;
        }
        else if($datos['casoRegistro'] == 'colaboradorConActivo'){
            $datos['codigo_activo'] = 'Computador '.$datos['codigo'];
            $datos['ingreso_activo'] = date('Y-m-d H:i:s');
            $datos['empresa_visitada'] = null;
            $datos['colaborador'] = null;
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
            'id_usuario' => $datos['id_usuario'],
        ])->save(); 

        return $datos;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Función que recibe una petición de Ajax para obtener los registros de un grupo de personas en específico (Visitantes, Colaboradores, Colaboradores con activo, Conductores) en la tabla se_personas.
    */
    public function getPersonas(Request $request){
        $tipoPersona = $request->input('tipoPersona');
        $personas = $this->personas->obtenerPersonas($tipoPersona);
        $response = ['data' => $personas];

        return response()->json($response);
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
            $vehiculos = PersonaVehiculo::select('vehiculos.*', 'tipo.tipo', 'marca.marca')
            ->leftjoin('se_vehiculos AS vehiculos', 'se_per_vehi.id_vehiculo', '=', 'vehiculos.id_vehiculos')
            ->leftjoin('se_tipo_vehiculos AS tipo', 'vehiculos.id_tipo_vehiculo', '=', 'tipo.id_tipo_vehiculos')
            ->leftjoin('se_marca_vehiculos AS marca', 'vehiculos.id_marca_vehiculo', '=', 'marca.id_marca_vehiculos')
            ->where('id_persona', $id)->get();
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return response()->json($vehiculos);
    }

    /**
     * Función que permite retornar todos los registros de la tabla se_registros asociados a las personas, vehículos y activos donde tengan un id en común.
     */
    public function informacionRegistros(Request $request){
        if($request->ajax()){
            $registros = $this->registros->informacionRegistros();
            return DataTables::of($registros)->make(true);
        }     
    }
}