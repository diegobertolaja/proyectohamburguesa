<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Entidades\Cliente;

class ControladorWebLogin extends Controller
{
    public function index()
    {
            $pg = "login";
            
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();

            return view("web.login", compact('pg', '$aSucursales'));
    }

    public function enviar(Request $request) {
        $correo = $request->input('txtCorreo');
        $clave = $request->input('txtClave');

        $cliente = New Cliente();
        $cliente->clave = $clave;
        $cliente->insertar();

        return redirect("/login");

    }
}
