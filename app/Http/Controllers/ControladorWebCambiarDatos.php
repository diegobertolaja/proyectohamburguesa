<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;
use Session;

class ControladorWebCambiarDatos extends Controller
{
    public function index()
    {
        $pg = "cambiar-datos";
            
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();  
                
    return view("web.cambiar-datos", compact('pg', 'aSucursales'));
}

    public function edtiar() {
        $cliente = new Cliente();
        $cliente->obtenerPorId(Session::get('idcliente'));
        
        $pg = "cambiar-datos";

        $nombre = $request->input(txtNombre);
        $apellido = $request->input(txtApellido);
        $mail = $request->input(txtMail);
        $dni = $request->input(txtDni);
        $telefono = $request->input(txtTelefono);
        $clave = $request->input(txtClave);

        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos(); 
     
        $cliente = new Cliente();
        $cliente->nombre = $nombre;
        $cliente-> apellido = $apellido;
        $cliente-> mail = $mail;
        $cliente-> dni = $dni;
       $cliente-> telefono = $telefono;
        $cliente->guardar();

    return view("web.login", compact('pg', 'aSucursales'));
}

}




