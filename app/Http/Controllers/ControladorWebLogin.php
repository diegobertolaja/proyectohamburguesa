<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;

class ControladorWebLogin extends Controller
{
    public function index()
    {
            $pg = "login";
            
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            return view("web.login", compact('pg', '$aSucursales'));
    }
}
