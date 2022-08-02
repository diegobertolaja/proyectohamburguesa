<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

class ControladorWebContacto extends Controller
{
    public function index()
    {
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();     
        return view("web.contacto", compact('aSucursales'));
    }

    public function enviar(Request $request) {
        
        $nombre = $request->input('txtNombre');
        $telefono = $request->input('txtTelefono');
        $mail = $request->input('txtMail');
        $mensaje = $request->input('txtMensaje');

        return redirect("/confirmacion-envio");         
        
    }

    
}
