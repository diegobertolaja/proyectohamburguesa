<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

class ControladorWebContacto extends Controller
{
    public function index()
    {
        $pg = "contacto";
            
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();     
        return view("web.contacto", compact('pg', '$aSucursales'));
    }
}
