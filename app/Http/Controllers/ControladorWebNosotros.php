<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

class ControladorWebNosotros extends Controller
{
    public function index()
    {
        $pg = "nosotros";
            
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();    
        
        return view("web.nosotros", compact('pg', '$aSucursales'));
    }
}

