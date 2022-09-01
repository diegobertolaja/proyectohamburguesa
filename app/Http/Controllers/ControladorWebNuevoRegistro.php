<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;

class ControladorWebNuevoRegistro extends Controller
{
    public function index()
    {
            $pg = "nuevo-registro";
            
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            return view("web.nuevo-registro", compact('pg', 'aSucursales'));
    }
    
    public function enviar(Request $request) {
        $nombre = $request->input('txtNombre');
        $apellido = $request->input('txtApellido');
        $mail = $request->input('txtMail');
        $dni = $request->input('txtDni');
        $telefono = $request->input('txtTelefono');
        $clave = $request->input('txtClave');


        $cliente = New Cliente();
        $cliente->nombre = $nombre;
        $cliente->apellido = $apellido;
        $cliente->mail = $mail;
        $cliente->dni = $dni;
        $cliente->telefono = $telefono;
        $cliente->clave = password_hash($clave, PASSWORD_DEFAULT);
        $cliente->insertar ();
        

            return redirect("/login");
           
    }

    }
    ?>