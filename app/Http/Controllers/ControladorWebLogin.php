<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Entidades\Cliente;
use Session;
class ControladorWebLogin extends Controller
{
    public function index()
    {
            $pg = "login";
            
            $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();

            return view("web.login", compact('pg', '$aSucursales'));
  }
  
    public function ingresar (Request $request) {
      $sucursal = New Sucursal();
      $aSucursales = $sucursal-> obtenerTodos();

      $pg = "login";
      $mail = $request->input('txtMail');
      $clave = $request->input('txtClave');

      $cliente = New Cliente();
      $cliente->obtenerPorMail($mail);

      $pedido = New Pedido();
      $aPedidos = $pedido->obtenerPorCliente(Session::get("idcliente"));

      if($cliente->idcliente > 0 && passsword_verify($clave, $cliente->clave));

        $cliente->obtenerPorId($cliente->idcliente);
        Session::put("idcliente", $cliente->idcliente);
        return view ("web.mi-cuenta", compact('cliente', '$aSucursales', 'aPedidos'));

    } else {
        $msg["msg"]= "Correo o clave incorrecto";
        $msg["estado"]= "danger";
        return view ("/web.login", compact('msg', '$aSucursales', 'pg'));    
    }

  
 



      
      
        

    
