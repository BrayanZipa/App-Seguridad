<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPersona;
use App\Models\Activo;
use App\Models\Arl;
use App\Models\Empresa;
use App\Models\Eps;
use App\Models\MarcaVehiculo;
use App\Models\Persona;
use App\Models\PersonaVehiculo;
use App\Models\Registro;
use App\Models\TipoPersona;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class VisitanteController extends Controller
{
    protected $visitantes;
    protected $eps;
    protected $arl;
    protected $tipoVehiculos;
    protected $marcaVehiculos;
    protected $empresas;
    protected $tipoPersonas;

    /**
     * Contructor que inicializa todos los modelos
     */
    public function __construct(Persona $visitantes, Eps $eps, Arl $arl, TipoVehiculo $tipoVehiculos, MarcaVehiculo $marcaVehiculos, TipoPersona $tipoPersonas, Empresa $empresas)
    {
        $this->visitantes = $visitantes;
        $this->eps = $eps;
        $this->arl = $arl;
        $this->tipoVehiculos = $tipoVehiculos;
        $this->marcaVehiculos = $marcaVehiculos;
        $this->tipoPersonas = $tipoPersonas;
        $this->empresas = $empresas;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitCode = Artisan::call('cache:clear');
        $tipoPersonas = $this->tipoPersonas->obtenerTipoPersona();
        [$eps, $arl, $tipoVehiculos, $marcaVehiculos] = $this->obtenerModelos();
        return view('pages.visitantes.mostrar', compact('eps', 'arl', 'tipoVehiculos', 'marcaVehiculos', 'tipoPersonas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exitCode = Artisan::call('cache:clear');
        $empresas = $this->empresas->obtenerEmpresas();
        [$eps, $arl, $tipoVehiculos, $marcaVehiculos] = $this->obtenerModelos();
        return view('pages.visitantes.crear', compact('eps', 'arl', 'tipoVehiculos', 'marcaVehiculos', 'empresas'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestPersona $request)
    {
        // return $request->all();
        $nuevoVisitante = $request->all();

        if($nuevoVisitante['casoIngreso'] == 'casoVehiculo'){
            $this->validarVehiculo($request);
          
        } else if ($nuevoVisitante['casoIngreso'] == 'casoActivo'){
            $this->validarActivo($request);

        } else if ($nuevoVisitante['casoIngreso'] == 'casoVehiculoActivo'){
            $this->validarVehiculo($request);
            $this->validarActivo($request);
        }

        $nuevoVisitante['nombre'] = ucwords(mb_strtolower($nuevoVisitante['nombre']));
        $nuevoVisitante['apellido'] = ucwords(mb_strtolower($nuevoVisitante['apellido']));
        $nuevoVisitante['colaborador'] = ucwords(mb_strtolower($nuevoVisitante['colaborador']));
        $nuevoVisitante['descripcion'] = ucfirst(mb_strtolower($nuevoVisitante['descripcion']));
        $nuevoVisitante['identificador'] = strtoupper($nuevoVisitante['identificador']);
        $nuevoVisitante['activo'] = ucwords(mb_strtolower($nuevoVisitante['activo']));
        $nuevoVisitante['codigo'] = ucfirst($nuevoVisitante['codigo']);
        $nuevoVisitante['id_tipo_persona'] = 1;
        $nuevoVisitante['id_usuario'] = auth()->user()->id_usuarios;
        
        if(!isset($nuevoVisitante['foto'])){ //saber si es null
            $url = null;
        } else{
            $img = $request->foto;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $foto = base64_decode($img);
            $filename = 'visitantes/'. $nuevoVisitante['identificacion']. '_'. date('Y-m-d'). '.png';
            $ruta = storage_path() . '\app\public/' .  $filename;
            Image::make($foto)->resize(600, 500)->save($ruta);
            $url = Storage::url($filename);
        }      

        //Crear registro de nuevo visitante dato a dato con la información del request
        $visitante = Persona::create([
            'id_usuario' => $nuevoVisitante['id_usuario'],
            'id_tipo_persona' => $nuevoVisitante['id_tipo_persona'],
            'nombre' => $nuevoVisitante['nombre'],
            'apellido' => $nuevoVisitante['apellido'],
            'identificacion' => $nuevoVisitante['identificacion'],
            'id_eps' => $nuevoVisitante['id_eps'],
            'id_arl' => $nuevoVisitante['id_arl'],
            'foto' => $url,
            'tel_contacto' => $nuevoVisitante['tel_contacto'],
        ]);
        $visitante->save();

        //Ingreso de datos dependiendo de que formularios fueron ingresados
        if($nuevoVisitante['casoIngreso'] == 'casoVehiculo'){
            [$mensajeVehiculo, $id_vehiculo] = $this->store2($nuevoVisitante, $visitante->id_personas);
            $this->store4($nuevoVisitante, $visitante->id_personas, $id_vehiculo);
            $modal = [$visitante->nombre.' '.$visitante->apellido, $mensajeVehiculo];
            return redirect()->action([VisitanteController::class, 'create'])->with('crear_visitante_vehiculo', $modal);

        } else if($nuevoVisitante['casoIngreso'] == 'casoActivo'){
            $mensajeActivo = $this->store3($nuevoVisitante, $visitante->id_personas);
            $this->store4($nuevoVisitante, $visitante->id_personas, null);
            $modal = [$visitante->nombre.' '.$visitante->apellido, $mensajeActivo];
            return redirect()->action([VisitanteController::class, 'create'])->with('crear_visitante_activo', $modal);
            
        } else if($nuevoVisitante['casoIngreso'] == 'casoVehiculoActivo'){
            [$mensajeVehiculo, $id_vehiculo] = $this->store2($nuevoVisitante, $visitante->id_personas);
            $mensajeActivo = $this->store3($nuevoVisitante, $visitante->id_personas);
            $this->store4($nuevoVisitante, $visitante->id_personas, $id_vehiculo);
            $modal = [$visitante->nombre.' '.$visitante->apellido, $mensajeVehiculo, $mensajeActivo];
            return redirect()->action([VisitanteController::class, 'create'])->with('crear_visitante_vehiculoActivo', $modal);
            
        } else {
            $this->store4($nuevoVisitante, $visitante->id_personas, null);
            return redirect()->action([VisitanteController::class, 'create'])->with('crear_visitante', $visitante->nombre.' '.$visitante->apellido);
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
        if($datos['casoIngreso'] == 'casoVehiculo'){
            Registro::create([
                'id_persona' => $id_persona,
                'ingreso_persona' => date('Y-m-d H:i:s'),
                'ingreso_vehiculo' => date('Y-m-d H:i:s'),
                'id_vehiculo' => $id_vehiculo,
                'descripcion' => $datos['descripcion'],
                'id_empresa' => $datos['id_empresa'],
                'colaborador' => $datos['colaborador'],
                'id_usuario' => $datos['id_usuario'],
            ])->save(); 

        } else if ($datos['casoIngreso'] == 'casoActivo'){
            Registro::create([
                'id_persona' => $id_persona,
                'ingreso_persona' => date('Y-m-d H:i:s'),
                'ingreso_activo' => date('Y-m-d H:i:s'),
                'descripcion' => $datos['descripcion'],
                'id_empresa' => $datos['id_empresa'],
                'colaborador' => $datos['colaborador'],
                'id_usuario' => $datos['id_usuario'],
            ])->save(); 

        } else if ($datos['casoIngreso'] == 'casoVehiculoActivo'){
            Registro::create([
                'id_persona' => $id_persona,
                'ingreso_persona' => date('Y-m-d H:i:s'),
                'ingreso_vehiculo' => date('Y-m-d H:i:s'),
                'id_vehiculo' => $id_vehiculo,
                'ingreso_activo' => date('Y-m-d H:i:s'),
                'descripcion' => $datos['descripcion'],
                'id_empresa' => $datos['id_empresa'],
                'colaborador' => $datos['colaborador'],
                'id_usuario' => $datos['id_usuario'],
                ])->save();  

        } else {
            Registro::create([
                'id_persona' => $id_persona,
                'ingreso_persona' => date('Y-m-d H:i:s'),
                'descripcion' => $datos['descripcion'],
                'id_empresa' => $datos['id_empresa'],
                'colaborador' => $datos['colaborador'],
                'id_usuario' => $datos['id_usuario'],
            ])->save(); 
        }
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
    public function update(RequestPersona $request, $id)
    {
        $visitante = $request->all();
        $visitante['nombre'] = ucwords(mb_strtolower($visitante['nombre']));
        $visitante['apellido'] = ucwords(mb_strtolower($visitante['apellido']));
        // $visitante = Visitante::find($id)->fill($request->all())->save();
        Persona::findOrFail($id)->update($visitante);
        return redirect()->action([VisitanteController::class, 'index'])->with('editar_visitante', $visitante['nombre']." ".$visitante['apellido']);
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
        return response()->json($this->visitantes->informacionPersonas(1));      
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
    
    /**
     * Función que permite validar los datos ingresados en el formulario de activo.
     */
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
    }
}