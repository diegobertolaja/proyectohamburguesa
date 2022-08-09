<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use Session;

class ControladorWebMercadoPago extends Controller
{
    public function aprobar($idCliente)
    {
      $pedido = New Pedido();
      $pedido->aprobar($idCliente); 
      return redirect("/mi-cuenta");   
    }
    public function pendiente($idCliente)
    {
        $pedido = New Pedido();
        $pedido->pendienter($idCliente);  
        return redirect("/mi-cuenta");       
    }
    public function error($idCliente)
    {
        $pedido = New Pedido();
        $pedido->error($idCliente); 
        return redirect("/mi-cuenta");        
    }
}

?>
