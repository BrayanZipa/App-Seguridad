<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use App\Models\Eps;
use App\Models\Persona;
use App\Models\Registro;
use App\Models\TipoPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\DataTables;

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

    public function __construct(Registro $registros, TipoPersona $tipoPersonas, Persona $personas, Eps $eps, Arl $arl){
        $this->registros = $registros;
        $this->tipoPersonas = $tipoPersonas;
        $this->personas = $personas;
        $this->eps = $eps;
        $this->arl = $arl;
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
        return view('pages.registros.crear',  compact('eps', 'arl', 'tipoPersonas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Función que recibe una petición de Ajax para obtener los datos de una persona de tipo visitante que este creada en la tabla se_personas.
     */
    public function getPersona(Request $request)
    {
        $id = $request->input('persona');
        return $this->personas->obtenerPersona($id);
    }

    /**
     * Función que permite retornar todos los registros de la tabla se_registros asociados a las personas, vehículos y activos donde tengan un id en común.
     */
    public function informacionRegistros(Request $request)
    {
        if($request->ajax()){
            $registros = $this->registros->informacionRegistros();
            return DataTables::of($registros)->make(true);
        }     
    }
    
    // Persona::where('id_tipo_persona', 1)->where('identificacion', $busqueda)->orWhere();  
}