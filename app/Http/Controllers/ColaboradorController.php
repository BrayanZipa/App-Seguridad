<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use App\Models\Empresa;
use App\Models\Eps;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class ColaboradorController extends Controller
{
    protected $conductores;
    protected $eps;
    protected $arl;
    protected $empresas;

    public function __construct(Persona $conductores, Eps $eps, Arl $arl, Empresa $empresas){
        $this->conductores = $conductores;
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
        $exitCode = Artisan::call('cache:clear');

        // $session_token = Http::withHeaders([
        //     'Authorization' => 'user_token '.env('API_KEY', 'No hay Token')
        // ])->get(env('API_URL', 'No hay URL').'initSession/2');

        // // return 'Session-Token: '.$session_token['session_token'];

        // $usuarios = Http::withHeaders([
        //     'Session-Token' => $session_token['session_token']
        // ])->get(env('API_URL', 'No hay URL').'computer/', [
        //     'range' => '0-300'
        //     // "items" => ["itemtype" => "User", "items_id"=> 2]
        //     // "items" => ["itemtype"=> "User", "items_id"=> 2, "itemtype"=> "Entity", "items_id"=> 0]
        //     // "items" => [{"itemtype"=> "User", "items_id"=> 2}, {"itemtype"=> "Entity", "items_id"=> 0}]
        // ]);

        // return $usuarios;

        // $usuarios2 = Http::withHeaders([
        //     'Session-Token' => $session_token['session_token']
        // ])->get($usuarios[0]['links'][5]['href']);

        // $array = $usuarios->json(); 
        // // return   $usuarios[0]['links'][5]['href'];  
        // return $usuarios2;

        [$eps, $arl, $empresas] = $this->obtenerModelos();
        return view('pages.colaboradores.mostrar', compact('eps', 'arl', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exitCode = Artisan::call('cache:clear');

        $session_token = Http::withHeaders([
            'Authorization' => 'user_token '.env('API_KEY', 'No hay Token')
        ])->get(env('API_URL', 'No hay URL').'initSession/2');

        // return 'Session-Token: '.$session_token['session_token'];

        $usuarios = Http::withHeaders([
            'Session-Token' => $session_token['session_token']
        ])->get(env('API_URL', 'No hay URL').'computer/', [
            'range' => '0-300'
            // "items" => ["itemtype" => "User", "items_id"=> 2]
            // "items" => ["itemtype"=> "User", "items_id"=> 2, "itemtype"=> "Entity", "items_id"=> 0]
            // "items" => [{"itemtype"=> "User", "items_id"=> 2}, {"itemtype"=> "Entity", "items_id"=> 0}]
        ]);

        $array = $usuarios->json(); 
        // return $array;

        [$eps, $arl, $empresas] = $this->obtenerModelos();
        return view('pages.colaboradores.crear', compact('eps', 'arl', 'empresas', 'array'));
    }



    public function getPersona(Request $request){

        // $session_token = Http::withHeaders([
        //     'Authorization' => 'user_token '.env('API_KEY', 'No hay Token')
        // ])->get(env('API_URL', 'No hay URL').'initSession/2');

        // $usuarios2 = Http::withHeaders([
        //         'Session-Token' => $session_token['session_token']
        // ])->get(env('API_URL', 'No hay URL').);
    
        // $array = $usuarios2->json(); 
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoColaborador = $request->all();
        $nuevoColaborador['id_tipo_persona'] = 2;
        $nuevoColaborador['id_usuario'] = auth()->user()->id_usuarios;
        // $nuevoVisitante['foto'] = '';
        Persona::create($nuevoColaborador)->save();
        return redirect()->action([ColaboradorController::class, 'index']);
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
     * Función que permite traer la información de los modelos de la Eps, Arl y Empresa
     */
    public function obtenerModelos()
    {
        $eps = $this->eps->obtenerEps();
        $arl = $this->arl->obtenerArl();
        $empresas = $this->empresas->obtenerEmpresas();
        return [$eps, $arl, $empresas];
    }

    /**
     * Función que permite retornar en un formato JSON los datos de los colaboradores, arl, eps y empresa donde tengan un id en común.
     */
    public function informacionVisitantes()
    {
        return response()->json( $this->visitantes->informacionPersonas(2));      
    } 
}