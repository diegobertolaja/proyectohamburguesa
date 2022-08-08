<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Entidades\Cliente;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use App\Entidades\Pedido;
use App\Entidades\Carrito_producto;
use Session;

use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

require app_path() . '/start/constants.php';

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
            $aCarritos_productos = $carrito_producto->obtenerPorCarrito();
         } else {
               $aCarritos_productos = array(),
         
         } else {      

            $msg ['estado'] = "info";
            $msg ['mensaje'] = "Su carrito está vacío. Agregue productos.";
         }
         $sucursal = New Sucursal();
            $aSucursales = $sucursal-> obtenerTodos();
            
            $pg = "carrito";
            return view("web.carrito", compact('pg', 'carrito', 'carrito_producto', 'aSucursales'));
      }  
}
    }
      
      public function finalizarPedido(Request $request){
            $pedido = New Pedido();
            $pedido->fecha = Date("Y-m-d H:i:s");
            $medioDePago = $request->input('lstMedioDePago');

            $carrito_producto = New Carrito_producto();
            $carrito_producto->obtenerPorCliente(Session::get("idcliente"));
      
            foreach($aCarritosProductos as $carrito){
            $pedido->descripcion .= $carrito->producto . " - ";
            $pedido->total = $carrito->cantidad * $carrito->$precio;
}

            $pedido->fk_idsucursal = $request->input('lstSucursal');
            $pedido->fk_idcliente = Session::get("idcliente");
           
            If($medioDePago == "sucursal"){  
      
          
            $pedido->fk_idestado = PEDIDO_PENDIENTE;
            $pedido->insertar();
         }  else {
            //Abona por MP//
            SDK::setClientId(config("payment-methods.mercadopago.client"));
            SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
            SDK::setAccessToken($access_token); // Es el token de la cuenta MP donde se deposita el dinero//

            //Armado del producto 'item' //
            
            $item = New Item();
            $item->id = "1234";
            $item->tittle = "Hamburguejas SRL";
            $item->category_id = "products";
            $item->quantity = 1;
            $item->unit_price = $pedido->total;
            $item->currency_id = "ARS";

         }           

            //Vaciar el carrito//
            $carrito_producto->eliminarPorCliente(Session::get("idcliente")){
            
            $carrito = New Carrito();
            $carrito->eliminarPorCliente(Session::get("idcliente"))
            }
         }
        
            return redirect("/mi-cuenta");
      }
   
     
   ?>

   
     
