<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Pedido;
use Illuminate\Http\Request;
use Session;

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {         
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();  
        
        $cliente = New Cliente();
        $cliente->obtenerPorId(Session::get('idcliente'));     

        $pedido = New Pedido();
        $aPedidos = $pedido->obtenerPorCliente(Session::get("idcliente"));

        return view("web.mi-cuenta", compact('$aSucursales', 'cliente', 'aPedidos'));
    
}

    public function ingresar (Request $request) {
        $pg = "login";
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();  
         return view("web.mi-cuenta", compact('$aSucursales', 'cliente', 'aPedidos'));
    }
}

?>
