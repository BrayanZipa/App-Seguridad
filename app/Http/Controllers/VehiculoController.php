<?php

namespace App\Http\Controllers;

use App\Models\MarcaVehiculo;
use App\Models\Persona;
use App\Models\PersonaVehiculo;
use App\Models\TipoPersona;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $nuevoVehiculo = $request->all();

        $nuevoVehiculo['identificador'] = strtoupper($nuevoVehiculo['identificador']);
        $nuevoVehiculo['id_usuario'] = auth()->user()->id_usuarios;

        if(!isset($nuevoVehiculo['foto_vehiculo'])){ //saber si es null
            $url = null;
        } else {
            $img = $nuevoVehiculo['foto_vehiculo'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $foto = base64_decode($img);
            $filename = 'vehiculos/'. '$id_persona'. '_'. $nuevoVehiculo['identificador']. '_'.date('Y-m-d'). '.png';
            $ruta = storage_path() . '\app\public/' .  $filename;
            Image::make($foto)->resize(600, 500)->save($ruta);
            $url = Storage::url($filename);
        }

        if(!isset($nuevoVehiculo['id_marca_vehiculo'])){ //saber si existe
            $nuevoVehiculo['id_marca_vehiculo'] = null;
        }

        $vehiculo = Vehiculo::create([
            'identificador' => $nuevoVehiculo['identificador'],
            'id_tipo_vehiculo' => $nuevoVehiculo['id_tipo_vehiculo'],
            'id_marca_vehiculo' => $nuevoVehiculo['id_marca_vehiculo'],
            'foto_vehiculo' => $url,
            'id_usuario' => $nuevoVehiculo['id_usuario'],
        ]);
        $vehiculo->save();

        PersonaVehiculo::create([
            'id_vehiculo' => $vehiculo->id_vehiculos,
            'id_persona' => $nuevoVehiculo['id_persona'],
        ])->save();

        return redirect()->action([VehiculoController::class, 'create'])->with('crear_vehiculo', $vehiculo->identificador);
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
        $this->validarVehiculo($request);
        $vehiculo = $request->all();
        // return $vehiculo; 

        $vehiculo['identificador'] = strtoupper($vehiculo['identificador']);
        Vehiculo::findOrFail($id)->update($vehiculo);
        PersonaVehiculo::where('id_vehiculo', $id)->where('id_persona', $vehiculo['personaAnterior'])->update(['id_persona' => $vehiculo['id_persona']]);

        return redirect()->action([VehiculoController::class, 'index'])->with('editar_vehiculo', $vehiculo['identificador']);
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
            $vehiculos = PersonaVehiculo::leftjoin('se_personas AS persona', 'se_per_vehi.id_persona', '=', 'persona.id_personas')->leftjoin('se_vehiculos AS vehiculo', 'se_per_vehi.id_vehiculo', '=', 'vehiculo.id_vehiculos')->leftjoin('se_tipo_vehiculos AS tipo', 'vehiculo.id_tipo_vehiculo', '=', 'tipo.id_tipo_vehiculos')->leftjoin('se_marca_vehiculos AS marca', 'vehiculo.id_marca_vehiculo', '=', 'marca.id_marca_vehiculos')->leftjoin('se_usuarios AS usuario', 'vehiculo.id_usuario', '=', 'usuario.id_usuarios')->get();

            $response = ['data' => $vehiculos->all()];
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $response;     
    }

    //Función que recibe una petición de Ajax para obtener los registros de un grupo de personas en específico (Visitantes, Colaboradores, Conductores) en la tabla se_personas.
    public function getPersonas(Request $request){
        $tipoPersona = $request->input('tipoPersona');
        $personas = $this->personas->obtenerPersonas($tipoPersona);
        $response = ['data' => $personas];

        return response()->json($response);
    }

    /**
     * Función que permite validar los datos ingresados en el formulario de vehículo.
     */
    public function validarVehiculo(Request $request){
        $this->validate($request, [
            'identificador' => 'required|string|unique:se_vehiculos,identificador,'.$request->id.',id_vehiculos|alpha_num|max:15|min:6',
            'id_tipo_vehiculo' => 'required|integer',   
            'id_marca_vehiculo' => 'integer|nullable',
            'id_persona' => 'required|integer', 
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

            'id_marca_vehiculo.integer' => 'La marca del vehículo debe ser de tipo entero',

            'id_persona.required' => 'Se requiere que ingrese al propietario del vehículo',
            'id_persona.integer' => 'El propietario del vehículo debe ser de tipo entero',

            'foto_vehiculo.required' => 'Se requiere que tome una foto del vehículo',
            'foto_vehiculo.string' => 'La información de la foto del vehículo debe estar en formato de texto',
        ]);
    }
}
