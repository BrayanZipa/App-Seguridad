<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use App\Models\Eps;
use App\Models\Persona;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    protected $conductores;
    protected $eps;
    protected $arl;

    public function __construct(Persona $conductores, Eps $eps, Arl $arl){
        $this->conductores = $conductores;
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
        [$eps, $arl] = $this->obtenerModelos();
        return view('pages.conductores.crear', compact('eps', 'arl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoConductor = $request->all();
        $nuevoConductor['id_tipo_persona'] = 3;
        $nuevoConductor['id_usuario'] = auth()->user()->id_usuarios;
        // $nuevoVisitante['foto'] = '';
        Persona::create($nuevoConductor)->save();
        return redirect()->action([ConductorController::class, 'index']);
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
     * Función que permite traer la información de los modelos de la Eps y Arl
     */
    public function obtenerModelos()
    {
        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        return [$eps, $arl];
    }

    /**
     * Función que permite retornar en un fotmato JSON los datos de los conductores, arl y eps donde tengan un id en común.
     */
    public function informacionVisitantes()
    {
        return response()->json( $this->visitantes->informacionPersonas(3));      
    } 
}