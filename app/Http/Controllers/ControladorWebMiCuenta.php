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
        $aPedidos->obtenerPorCliente(Session::get("$idcliente"));

        return view("web.mi-cuenta", compact('$aSucursales', 'cliente'));
    
}
}
