<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Entidades\Cliente;
use Illuminate\Http\Request;


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

    public function ingresar (Request $request) {
        $mail = $request->input('txtMail');
        $clave = $request->input('txtClave');

        $cliente = New Cliente();
        $cliente->obtenerPorMail($mail);
        if($cliente->idcliente > 0 && passsword_verify($clave, $cliente->clave));
          return redirect("/mi-cuenta");
        }   else {
            $msg = "Usuario o clave incorrecta";
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();

            return redirect("/web.login", compact('msg', '$aSucursales'));

        } 
      
        

    
