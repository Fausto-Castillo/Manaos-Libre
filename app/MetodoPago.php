<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    //
    public $table = "metodos_de_pago";
    public $timestamps  = false;
    public $guarded = [];

}
