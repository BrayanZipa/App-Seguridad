<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPersona;
use App\Http\Requests\RequestVehiculo;
use App\Models\Activo;
use App\Models\Arl;
use App\Models\Eps;
use App\Models\MarcaVehiculo;
use App\Models\Persona;
use App\Models\PersonaVehiculo;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    protected $visitantes;
    protected $eps;
    protected $arl;
    protected $tipoVehiculos;
    protected $marcaVehiculos;

    /**
     * Contructor que inicializa todos los modelos
     */
    public function __construct(Persona $visitantes, Eps $eps, Arl $arl, TipoVehiculo $tipoVehiculos, MarcaVehiculo $marcaVehiculos)
    {
        $this->visitantes = $visitantes;
        $this->eps = $eps;
        $this->arl = $arl;
        $this->tipoVehiculos = $tipoVehiculos;
        $this->marcaVehiculos = $marcaVehiculos;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        [$eps, $arl, $tipoVehiculos, $marcaVehiculos] = $this->obtenerModelos();
        return view('pages.visitantes.mostrar', compact('eps', 'arl', 'tipoVehiculos', 'marcaVehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $personas = $this->visitantes->obtenerPersonas(2); , 'personas'
        [$eps, $arl, $tipoVehiculos, $marcaVehiculos] = $this->obtenerModelos();
        return view('pages.visitantes.crear', compact('eps', 'arl', 'tipoVehiculos', 'marcaVehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestPersona $request)
    {
        $nuevoVisitante = $request->all();

        if($nuevoVisitante['casoIngreso'] == 'casoVehiculo'){
            $this->validarVehiculo($request);
            dd($request->all());
            
        } else if ($nuevoVisitante['casoIngreso'] == 'casoActivo'){
            $this->validarActivo($request);

        } else if ($nuevoVisitante['casoIngreso'] == 'casoVehiculoActivo'){
            $this->validarVehiculo($request);
            // $this->validarActivo($request);
        }

        dd($request->all());
        
        $nuevoVisitante['id_tipo_persona'] = 1;
        $nuevoVisitante['id_usuario'] = auth()->user()->id_usuarios;
        // $nuevoVisitante['foto'] = '';
    //    dd($nuevoVisitante);

        //Crear registro de nuevo visitante dato a dato con la información del request
        $visitante = Persona::create([
            'id_usuario' => $nuevoVisitante['id_usuario'],
            'id_tipo_persona' => $nuevoVisitante['id_tipo_persona'],
            'nombre' => $nuevoVisitante['nombre'],
            'apellido' => $nuevoVisitante['apellido'],
            'identificacion' => $nuevoVisitante['identificacion'],
            'id_eps' => $nuevoVisitante['id_eps'],
            'id_arl' => $nuevoVisitante['id_arl'],
            'tel_contacto' => $nuevoVisitante['tel_contacto'],
        ]);
        $visitante->save();

        //Ingreso de datos dependiendo de que formularios fueron ingresados
        if($nuevoVisitante['casoIngreso'] == 'casoVehiculo'){
            $mensajeVehiculo = $this->store2($nuevoVisitante, $visitante->id_personas);
            $modal = [$visitante->nombre.' '.$visitante->apellido, $mensajeVehiculo];
            return redirect()->action([VisitanteController::class, 'create'])->with('crear_visitante_vehiculo', $modal);

        } else if($nuevoVisitante['casoIngreso'] == 'casoActivo'){
            $mensajeActivo = $this->store3($nuevoVisitante, $visitante->id_personas);
            $modal = [$visitante->nombre.' '.$visitante->apellido, $mensajeActivo];
            return redirect()->action([VisitanteController::class, 'create'])->with('crear_visitante_activo', $modal);
            
        } else if($nuevoVisitante['casoIngreso'] == 'casoVehiculoActivo'){
            $mensajeVehiculo = $this->store2($nuevoVisitante, $visitante->id_personas);
            $mensajeActivo = $this->store3($nuevoVisitante, $visitante->id_personas);
            $modal = [$visitante->nombre.' '.$visitante->apellido, $mensajeVehiculo, $mensajeActivo];
            return redirect()->action([VisitanteController::class, 'create'])->with('crear_visitante_vehiculoActivo', $modal);
            
        } else {
            return redirect()->action([VisitanteController::class, 'create'])->with('crear_visitante', $visitante->nombre.' '.$visitante->apellido);
        }   
    }

    //Función que permite registrar un nuevo vehículo creado desde el modulo de visitantes
    public function store2($datos, $id_persona)
    {
        $vehiculo = Vehiculo::create([
            'identificador' => $datos['identificador'],
            'id_tipo_vehiculo' => $datos['id_tipo_vehiculo'],
            'id_marca_vehiculo' => $datos['id_marca_vehiculo'],
            //foto
            'id_usuario' => $datos['id_usuario'],
        ]);
        $vehiculo->save();

        PersonaVehiculo::create([
            'id_vehiculo' => $vehiculo->id_vehiculos,
            'id_persona' => $id_persona,
        ])->save();

        return $vehiculo->identificador;
    }

    //Función que permite registrar un nuevo activo creado desde el modulo de visitantes
    public function store3($datos, $id_persona)
    {
        // dd($datos, $id_persona);

        $activo = Activo::create([
            'activo' => $datos['activo'],
            'codigo' => $datos['codigo'],
            'id_usuario' => $datos['id_usuario'],
            'id_persona' => $id_persona,
        ]);
        $activo->save();
        // dd($activo);
        return $activo->codigo;
    }

   /*  public function show($id)
    {
        $visitante = $this->visitantes->obtenerVisitante($id);
        return view('pages.visitantes.ver', ['visitante' => $visitante]);
    } */

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function edit($id)
    {
        $visitante = $this->visitantes->obtenerVisitante($id);
        [$eps, $arl] = $this->obtenerModelos();  
        $datoIndividual = array($this->eps->obtenerEpsIndividual($visitante->id_eps), $this->arl->obtenerArlIndividual($visitante->id_arl));
        // dd(compact('visitante', 'eps', 'arl', 'datoIndividual'));
        return view('pages.visitantes.editar', compact('visitante', 'eps', 'arl', 'datoIndividual')); 
    } */

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $visitante = Visitante::find($id)->fill($request->all())->save();
        Persona::findOrFail($id)->update($request->all());
        return redirect()->action([VisitanteController::class, 'index'])->with('editar_visitante', $request->all()['nombre']." ".$request->all()['apellido']);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function destroy($id)
    {
        $visitante = Visitante::find($id);
        // $visitante = $this->visitantes->obtenerVisitante($id);
        $visitante->delete();
        return redirect()->action([VisitanteController::class, 'index']);
    } */

    /**
     * Función que permite traer la información de los modelos de la Eps, Arl, TipoVehiculo y MarcaVehiculo
     */
    public function obtenerModelos()
    {
        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        $tipoVehiculos = $this->tipoVehiculos->obtenerTipoVehiculos();
        $marcaVehiculos = $this->marcaVehiculos->obtenerMarcaVehiculos();

        return [$eps, $arl, $tipoVehiculos, $marcaVehiculos];
    }

    /**
     * Función que permite retornar en un formato JSON los datos de los visitantes, arl y eps donde tengan un id en común.
     */
    public function informacionVisitantes()
    {
        return response()->json( $this->visitantes->informacionPersonas(1));      
    }
    
    public function validarVehiculo(Request $request){
        $this->validate($request, [
            'identificador' => 'required|string|unique:se_vehiculos,identificador|alpha_dash|max:15|min:6',
            'id_tipo_vehiculo' => 'required|integer',   
            'id_marca_vehiculo' => 'integer|nullable',  
        ],[
            'identificador.required' => 'Se requiere que ingrese el identificador del vehículo',
            'identificador.string' => 'El identificador debe ser de tipo texto',
            'identificador.unique' => 'No puede haber dos vehículos con el mismo número identificador',
            'identificador.alpha_dash' => 'El identificador del vehículo solo debe contener valores alfanuméricos',
            'identificador.max' => 'El identificador del vehículo no puede tener más de 15 caracteres',
            'identificador.min' => 'El identificador del vehículo no puede tener menos de 6 caracteres',

            'id_tipo_vehiculo.required' => 'Se requiere que elija una opción en el tipo de vehículo',
            'id_tipo_vehiculo.integer' => 'El tipo de vehículo debe ser de tipo entero',

            'id_marca_vehiculo.integer' => 'La marca ded vehículo debe ser de tipo entero',
        ]);
        
        dd($request->all());
    }

    public function validarActivo(Request $request){
        $this->validate($request, [
            'activo' => 'required|string|alpha|max:20|min:3',
            'codigo' => 'required|string|alpha_num|unique:se_activos,codigo|max:5|min:4',   
        ],[
            'activo.required' => 'Se requiere que ingrese el nombre del activo',
            'activo.string' => 'El nombre del activo debe ser de tipo texto',
            'activo.alpha' => 'El nombre del activo solo debe contener valores alfabéticos',
            'activo.max' => 'El nombre del activo no puede tener más de 20 caracteres',
            'activo.min' => 'El nombre del activo no puede tener menos de 3 caracteres',

            'codigo.required' => 'Se requiere que ingrese el código del activo',
            'codigo.string' => 'El código del activo debe ser de tipo texto',
            'codigo.alpha_num' => 'El código del activo solo debe contener valores alfanuméricos',
            'codigo.unique' => 'No puede haber más de un activo con el mismo código',
            'codigo.max' => 'El código del activo no puede tener más de 5 caracteres',
            'codigo.min' => 'El código del activo no puede tener menos de 4 caracteres',
        ]);
        
        dd($request->all());
    }
}