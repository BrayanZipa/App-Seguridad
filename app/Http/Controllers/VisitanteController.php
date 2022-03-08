<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use App\Models\Eps;
use App\Models\Persona;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    protected $visitantes;
    protected $eps;
    protected $arl;

    public function __construct(Persona $visitantes, Eps $eps, Arl $arl)
    {
        $this->visitantes = $visitantes;
        $this->eps = $eps;
        $this->arl = $arl;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $visitantes = $this->visitantes->obtenerVisitantes();
        [$eps, $arl] = $this->obtenerModelos();
        return view('pages.visitantes.mostrar', compact('eps', 'arl'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        [$eps, $arl] = $this->obtenerModelos();
        return view('pages.visitantes.crear', compact('eps', 'arl'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoVisitante = $request->all();
        $nuevoVisitante['id_tipo_persona'] = 1;
        $nuevoVisitante['id_usuario'] = auth()->user()->id_usuarios;
        // $nuevoVisitante['foto'] = '';
        Persona::create($nuevoVisitante)->save();
        return redirect()->action([VisitanteController::class, 'index']);
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
        return redirect()->action([VisitanteController::class, 'index']);
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
     * Función que permite traer la información de los modelos de la Eps y Arl
     */
    public function obtenerModelos()
    {
        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        return [$eps, $arl];
    }

    /**
     * Función que permite retornar en un formato JSON los datos de los visitantes, arl y eps donde tengan un id en común.
     */
    public function informacionVisitantes()
    {
        return response()->json( $this->visitantes->informacionPersonas(1));      
    } 
}