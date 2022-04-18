<?php

namespace App\Http\Controllers;

use App\Models\MarcaVehiculo;
use App\Models\Persona;
use App\Models\TipoPersona;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class VehiculoController extends Controller
{
    protected $personas;
    protected $tipoVehiculos;
    protected $marcaVehiculos;
    protected $tipoPersonas;

    /**
     * Contructor que inicializa todos los modelos
     */
    public function __construct(Persona $personas, TipoVehiculo $tipoVehiculos, MarcaVehiculo $marcaVehiculos, TipoPersona $tipoPersonas)
    {
        $this->personas = $personas;
        $this->tipoVehiculos = $tipoVehiculos;
        $this->marcaVehiculos = $marcaVehiculos;
        $this->tipoPersonas = $tipoPersonas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitCode = Artisan::call('cache:clear');
        [$tipoVehiculos, $marcaVehiculos, $tipoPersonas] = $this->obtenerModelos();

        return view('pages.vehiculos.mostrar', compact('tipoVehiculos', 'marcaVehiculos', 'tipoPersonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exitCode = Artisan::call('cache:clear');
        [$tipoVehiculos, $marcaVehiculos, $tipoPersonas] = $this->obtenerModelos();

        return view('pages.vehiculos.crear', compact('tipoVehiculos', 'marcaVehiculos', 'tipoPersonas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarVehiculo($request);
        return $request->all();
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
     * Función que permite traer la información de los modelos de TipoVehiculo y MarcaVehiculo
     */
    public function obtenerModelos()
    {
        $tipoVehiculos = $this->tipoVehiculos->obtenerTipoVehiculos();
        $marcaVehiculos = $this->marcaVehiculos->obtenerMarcaVehiculos();
        $tipoPersonas = $this->tipoPersonas->obtenerTipoPersona();

        return [$tipoVehiculos, $marcaVehiculos, $tipoPersonas];
    }

     /**
     * Función que permite retornar en un formato JSON los datos de los vehículos, tipo, marca y las personas propietarias donde tengan un id en común.
     */
    public function informacionVehiculos()
    {
        try {
            $vehiculos = Vehiculo::leftjoin('se_per_vehi AS propietario', 'se_vehiculos.id_vehiculos', '=', 'propietario.id_vehiculo')->leftjoin('se_tipo_vehiculos AS tipo', 'se_vehiculos.id_tipo_vehiculo', '=', 'tipo.id_tipo_vehiculos')->leftjoin('se_marca_vehiculos AS marca', 'se_vehiculos.id_marca_vehiculo', '=', 'marca.id_marca_vehiculos')->leftjoin('se_usuarios AS usuarios', 'se_vehiculos.id_usuario', '=', 'usuarios.id_usuarios')->get();
            // ->where('id_tipo_persona', )->orderBy('id_personas')
            $response = ['data' => $vehiculos->all()];
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $response;     
    }

    /**
     * Función que permite validar los datos ingresados en el formulario de vehículo.
     */
    public function validarVehiculo(Request $request){
        $this->validate($request, [
            'identificador' => 'required|string|unique:se_vehiculos,identificador|alpha_num|max:15|min:6',
            'id_tipo_vehiculo' => 'required|integer',   
            'id_marca_vehiculo' => 'integer|nullable',
            'foto_vehiculo'  => 'required|string',
        ],[
            'identificador.required' => 'Se requiere que ingrese el número identificador del vehículo',
            'identificador.string' => 'El número identificador debe ser de tipo texto',
            'identificador.unique' => 'No puede haber dos vehículos con el mismo número identificador',
            'identificador.alpha_num' => 'El identificador del vehículo solo debe contener valores alfanuméricos',
            'identificador.max' => 'El identificador del vehículo no puede tener más de 15 caracteres',
            'identificador.min' => 'El identificador del vehículo no puede tener menos de 6 caracteres',

            'id_tipo_vehiculo.required' => 'Se requiere que elija una opción en el tipo de vehículo',
            'id_tipo_vehiculo.integer' => 'El tipo de vehículo debe ser de tipo entero',

            'id_marca_vehiculo.integer' => 'La marca ded vehículo debe ser de tipo entero',

            'foto_vehiculo.required' => 'Se requiere que tome una foto del vehículo',
            'foto_vehiculo.string' => 'La información de la foto del vehículo debe estar en formato de texto',
        ]);
    }
}
