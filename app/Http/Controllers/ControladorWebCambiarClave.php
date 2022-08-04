<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
            $pg = "nuevo-registro";
            
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            return view("web.nuevo-registro", compact('pg', '$aSucursales'));
    }
}