<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Entidades\Cliente;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use App\Entidades\Carrito_producto;
use Session;

class ControladorWebCarrito extends Controller
{
    public function index()
    {
      $idcliente = Session::get("idcliente");
      
      if($idcliente > 0 ){
         $carrito = New Carrito();
         
      if($carrito->obtenerPorCliente($idcliente) != Null){
         $carrito_producto = New Carrito_producto();
         if($carrito_producto->obtenerPorCarrito($carrito->idcarrito) != Null) {
            $idcarrito = $carrito->idcarrito;
            $aCarrito_producto = $carrito_producto->obtenerPorCarrito();
         } else {
            $msg ['estado'] = "info";
            $msg ['mensaje'] = "Su carrito está vacío. Agregue productos.";
         }
         $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            
            $pg = "carrito";
            return view("web.carrito", compact('pg', 'carrito', 'carrito_producto', 'aSucursales'));
      }  
      
      public function finalizarPedido(Request $request){
            $pedido = New Pedido();
            $pedido->fecha = Date("Y-m-d H:i:s");

            $carrito_producto = New Carrito_producto();
            $carrito_producto->obtenerPorCliente(Session::get("idcliente"));
            
            foreach($aCarritosProductos as $carrito){
            $pedido->descripcion .= $carrito->producto . " ";
            $pedido->total = $carrito->cantidad * $carrito * $precio;
      }
            $pedido->fk_idsucursal = $request->input('lstSucursal');
            $pedido->fk_idcliente = Session::get("idcliente");
            $pedido->fk_idestado = PEDIDO_PENDIENTE;
            $pedido->insertar();
            return redirect("/mi-cuenta");

      }

      }      
     
