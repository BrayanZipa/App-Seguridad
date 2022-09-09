<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements LdapAuthenticatable
{
    use Notifiable, AuthenticatesWithLdap, HasRoles;
    protected $table = 'se_usuarios';
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'company',
        'department',
        'city',
        'tittle',
        'username',
        'identification',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'id_usuarios';
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Función que asigna un rol a un usuario que ingresa a la aplicación e inicia sesión por primera vez.
     */
    public function asiganrRol($usuario)
    {
        try {
            $user = User::find($usuario->id_usuarios);
            $roles = $user->getRoleNames();
            if (empty($roles[0])) {
                if($usuario->department == 'Desarrollo'){
                    $user->assignRole(1);
                } else {
                    $user->assignRole(4);
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    // public function persona(){
    //     return $this->hasMany(Persona::class, 'id_usuario', 'id_usuarios'); 
    // }
}