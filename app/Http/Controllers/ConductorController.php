<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestConductor;
use App\Models\Arl;
use App\Models\Eps;
use App\Models\MarcaVehiculo;
use App\Models\Persona;
use App\Models\TipoPersona;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ConductorController extends Controller
{
    protected $conductores;
    protected $eps;
    protected $arl;
    protected $tipoVehiculos;
    protected $marcaVehiculos;
    protected $tipoPersonas;

    public function __construct(Persona $conductores, Eps $eps, Arl $arl, TipoVehiculo $tipoVehiculos, MarcaVehiculo $marcaVehiculos, TipoPersona $tipoPersonas){
        $this->conductores = $conductores;
        $this->eps = $eps;
        $this->arl = $arl;
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
        $tipoPersonas = $this->tipoPersonas->obtenerTipoPersona();
        [$eps, $arl, $tipoVehiculos, $marcaVehiculos] = $this->obtenerModelos();
        [$eps, $arl] = $this->obtenerModelos();
        return view('pages.conductores.mostrar', compact('eps', 'arl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exitCode = Artisan::call('cache:clear');
        [$eps, $arl, $tipoVehiculos, $marcaVehiculos] = $this->obtenerModelos();
        return view('pages.conductores.crear', compact('eps', 'arl', 'tipoVehiculos', 'marcaVehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestConductor $request)
    {
        // dd($request->all());
        $nuevoConductor = $request->all();
        $nuevoConductor['nombre'] = ucwords(mb_strtolower($nuevoConductor['nombre']));
        $nuevoConductor['apellido'] = ucwords(mb_strtolower($nuevoConductor['apellido']));
        // $nuevoConductor['identificador'] = strtoupper($nuevoConductor['identificador']);

        $nuevoConductor['id_tipo_persona'] = 3;
        $nuevoConductor['id_usuario'] = auth()->user()->id_usuarios;

        $img = $request->foto;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $foto = base64_decode($img);
        $filename = 'conductores/'. $nuevoConductor['identificacion']. '_'. date('Y-m-d'). '.png';
        $ruta = storage_path() . '\app\public/' .  $filename;
        Image::make($foto)->resize(600, 500)->save($ruta);
        $url = Storage::url($filename);

        $conductor = Persona::create([
            'id_usuario' => $nuevoConductor['id_usuario'],
            'id_tipo_persona' => $nuevoConductor['id_tipo_persona'],
            'nombre' => $nuevoConductor['nombre'],
            'apellido' => $nuevoConductor['apellido'],
            'identificacion' => $nuevoConductor['identificacion'],
            'id_eps' => $nuevoConductor['id_eps'],
            'id_arl' => $nuevoConductor['id_arl'],
            'foto' => $url,
            'tel_contacto' => $nuevoConductor['tel_contacto'],
        ]);
        $conductor->save();
        
        return redirect()->action([ConductorController::class, 'create']);
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
     * Función que permite retornar en un fotmato JSON los datos de los conductores, arl y eps donde tengan un id en común.
     */
    public function informacionVisitantes()
    {
        return response()->json( $this->conductores ->informacionPersonas(3));      
    } 
}