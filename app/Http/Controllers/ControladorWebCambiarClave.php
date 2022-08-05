<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
Use Session;


class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
            $pg = "inicio";
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            return view("web.cambiar-clave", compact('pg', '$aSucursales'));
    }

    public function guardar(Request $request) {
        $clave = $request->input('txtClave');
        $reClave = $request->input('txtReClave');

        if($clave == $reClave){
            $cliente = new Cliente();
            $cliente->obtenerPorId(Session::get('idcliente'));


        }
}
}