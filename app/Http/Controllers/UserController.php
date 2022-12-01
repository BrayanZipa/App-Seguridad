<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $usuarios;

    /**
     * Constructor que inicializa todos los modelos
     */
    public function __construct(User $usuarios)
    {
        $this->usuarios = $usuarios;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exitCode = Artisan::call('cache:clear');
        $this->usuarios->asiganrRol(auth()->user());
        $roles = Role::all();
        return view('pages.usuarios.administrarUsuarios', compact('roles'));
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
        $usuario = User::find($id);
        $rol = Role::find($request->role_id);
        if($request->role_id != $request->role_anterior){  
            $usuario->removeRole($request->role_anterior);
            $usuario->assignRole($rol);
        }
        return redirect()->action([UserController::class, 'index'])->with('rol_asignado', [$rol->name, $usuario->name]);
    }

    /**
     * Función que recibe una petición Ajax para retornar los usuarios registrados en la tabla se_usuarios unidos al rol que tengan asignado.
     */
    public function obtenerUsuarios(Request $request)
    {
        if($request->ajax()){
            try {
                $usuarios = User::with('roles:id,name')->get(['se_usuarios.id_usuarios', 'se_usuarios.name', 'se_usuarios.email']);
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
            }
            return DataTables::of($usuarios)->make(true);
        }
    }
}