<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

class ControladorWebGraciasPostulacion extends Controller
{
    public function index()
    {

        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();    
        
        return view("web.gracias-postulacion", compact('pg', '$aSucursales'));
    }

  
}
