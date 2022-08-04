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
        $pg = "mi-cuenta";
            
        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();  
        
        $cliente = New Cliente();
        $cliente->obtenerPorId(Session::get('idcliente'));    
           
        $pedido = New Pedido();
        
        return view("web.mi-cuenta", compact('pg', '$aSucursales', 'cliente'));
    }

    public function editar(Request $request){
    return view("web.cambiar-datos");
}
}
