<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;


class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
            $pg = "inicio";
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            return view("web.cambiar-clave", compact('pg', '$aSucursales'));
    }
}