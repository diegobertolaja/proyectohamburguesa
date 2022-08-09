<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

class ControladorWebRecuperarClave extends Controller
{
    public function index()
    {
            $pg = "recuperar-clave";
            
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            return view("web.recuperar-clave", compact('pg', '$aSucursales'));
    }
}

?>