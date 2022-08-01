<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        $pg = "mi-cuenta";
            
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();    
        
        return view("web.mi-cuenta", compact('pg', '$aSucursales'));
    }
}
