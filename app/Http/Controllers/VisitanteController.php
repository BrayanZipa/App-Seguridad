<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use App\Models\Eps;
use App\Models\Visitante;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class VisitanteController extends Controller
{
    protected $visitantes;
    protected $eps;
    protected $arl;

    public function __construct(Visitante $visitantes, Eps $eps, Arl $arl)
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
        Visitante::create($nuevoVisitante)->save();
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
        Visitante::findOrFail($id)->update($request->all());
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
     * Función que permite retornar en un fotmato JSON los datos de visitantes, ARL y ESP donde tenga un id en común.
     */
    public function informacionVisitantes()
    {
        try {
            $visitantes = Visitante::leftjoin('se_eps AS eps', 'se_personas.id_eps', '=', 'eps.id_eps')->leftjoin('se_arl AS arl', 'se_personas.id_arl', '=', 'arl.id_arl')->leftjoin('se_usuarios AS usuarios', 'se_personas.id_usuario', '=', 'usuarios.id_usuarios')->orderBy('id_personas')->get();
            $response = ['data' => $visitantes->all()];
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return response()->json($response);           
    } 
}
