<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use App\Models\Empresa;
use App\Models\Eps;
use App\Models\Persona;
use App\Models\Registro;
use App\Models\TipoPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\VisitanteController;
use App\Models\PersonaVehiculo;

class RegistroController extends Controller
{
    protected $registros;
    protected $tipoPersonas;
    protected $personas;
    protected $eps;
    protected $arl;
    protected $tipoVehiculos;
    protected $marcaVehiculos;
    protected $empresas;

    public function __construct(Registro $registros, TipoPersona $tipoPersonas, Persona $personas, Eps $eps, Arl $arl, Empresa $empresas){
        $this->registros = $registros;
        $this->tipoPersonas = $tipoPersonas;
        $this->personas = $personas;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->setMethod('PUT');
        return $request->all();
        // $id = $request->id_personas;
        // return redirect()->route('editarVisitante', ['id' => $id])->with($request->all());
        // return redirect('/visitantes/editar/'.$id)->with($request->all());
        // return redirect()->action([VisitanteController::class, 'update'], ['id' => $id]);
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
     * Función que permite actualizar la infromación de una persona en caso de que se desea cambiar al momento de hacer un nuevo registro.
     */
    public function updatePersona(Request $request, $id)
    {
        // return $id;
        // return $request->all();
        $persona = $request->all();
        $persona['nombre'] = ucwords(mb_strtolower($persona['nombre']));
        $persona['apellido'] = ucwords(mb_strtolower($persona['apellido']));
        // $persona['colaborador'] = ucwords(mb_strtolower($persona['colaborador']));
        // $persona['descripcion'] = ucfirst(mb_strtolower($persona['descripcion']));
        // $persona['activo'] = ucwords(mb_strtolower($persona['activo']));
        // $persona['codigo'] = ucfirst($persona['codigo']);
        // $persona['id_usuario'] = auth()->user()->id_usuarios;
        Persona::findOrFail($id)->update($persona);
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