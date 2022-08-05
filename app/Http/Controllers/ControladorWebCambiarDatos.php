<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;
use Session;

class ControladorWebCambiarDatos extends Controller
{
    public function index()
    {
        $pg = "cambiar-datos";
            
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();  
                
    return view("web.cambiar-datos", compact('pg', 'aSucursales'));
}
}
