<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'apellido', 'telefono', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $table = 'usuarios';

    public function productos () {
        return $this->hasMany('App\Producto', 'id_usuario');
    }

    public function valoraciones () {
        return $this->hasMany('App\Valoracion', 'id_usuario');
    }

    public function comentarios () {
        return $this->hasMany('App\Comentario', 'id_usuario');
    }

    public function direccion () {
        return $this->belongsTo('App\Direccion', 'id_direccion');
    }

    public function compras () {
        return $this->hasMany('App\Ventas', 'id_comprador');
    }
    
}
