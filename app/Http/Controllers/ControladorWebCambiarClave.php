<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
Use Session;


class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
            $pg = "cambiar clave";
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            return view("web.cambiar-clave", compact('pg', '$aSucursales'));
    }

    public function guardar(Request $request) {
        $pg = "cambiar clave";
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos()
        ;
        $clave = $request->input('txtClave');
        $reClave = $request->input('txtReClave');

        if($clave == $reClave){
            $cliente = new Cliente();
            $cliente->obtenerPorId(Session::get('idcliente'));
            $cliente->clave = $clave;
            $cliente->guardar();
            $msg['estado'] = "success";
            $msg['msg'] = "Clave cambiada exitosamente";
            return view("web.cambiar-clave", compact('pg', '$aSucursales', 'msg'));
       } else {
        $msg = "Las claves no coinciden";
        return view("web.cambiar-clave", compact('pg', '$aSucursales', 'msg'));

       }
}
}