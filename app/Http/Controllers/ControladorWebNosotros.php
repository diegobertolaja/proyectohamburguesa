<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Postulacion;
use Illuminate\Http\Request;

class ControladorWebNosotros extends Controller
{
    public function index()
    {
                 
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();    
        
        return view("web.nosotros", compact('pg', '$aSucursales'));
    }

    public function enviar (Request $request) {
        $nombre = $request->input('txtNombre');
        $apellido = $request->input('txtApellido');
        $telefono = $request->input('txtTelefono');
        $mail = $request->input('txtMail');
        $mensaje = $request->input('txtMensaje');

        $postulacion = New Postulacion();
        $postulacion->nombre = $nombre;
        $postulacion->apellido = $apellido;
        $postulacion->telefono = $telefono;
        $postulacion->mail =  $mail;
        $postulacion->mensaje = $mensaje;
        $postulacion->curriculum = $curriculum;
        $postulacion->insertar();

        return redirect("/gracias-postulacion");



    }
}

