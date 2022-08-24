<?php

namespace App\Http\Controllers;
use App\Entidades\Producto;
use App\Entidades\Categoria;
use App\Entidades\Carrito;
use App\Entidades\Carrito_producto;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Session;

class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $producto = New Producto();
        $aProductos = $producto->obtenerTodos();
        
        $categoria = New Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();

        $pg = 'takeaway';
        
        return view("web.takeaway", compact('pg', 'producto', 'aProductos', 'aCategorias', 'aSucursales'));
    }

    public function agregarAlCarrito(Request $request)
    {
        $producto = New Producto();
        $aProductos = $producto->obtenerTodos();
        
        $categoria = New Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $sucursal = New Sucursal();
        $aSucursales = $sucursal-> obtenerTodos();
        
        $pg = 'takeaway';

        //asigna variables a los datos cargados en los input//
        $cantidadProducto = $request->input("txtCantidadProducto");
        $idProductoSelect = $request->input("txtIdProducto");
        $idcliente = Session::get("idcliente");

        if($idcliente > 0){
          $carrito = New Carrito();
          $carrito_producto = New Carrito_producto(); 
        
          
        //si tiene carrito//
          if($carrito->obtenerPorCliente($idcliente) != NULL)  {
            $carrito_producto->fk_idcarrito = $carrito->idcarrito;

        } else {
        //si no tiene carrito crea un carrito para el cliente//    
            $carrito_producto->fk_idproducto = $idProductoSelect;
            $carrito_producto->cantidad = $cantidadProducto;
            $carrito_producto->insertar;
            
            $msg["estado"] = "success";
            $msg["mensaje"] = "Añadiste un producto a tu carrito";
            return view("web.takeaway", compact('msg', 'pg', 'producto', 'aProductos', 'aCategorias', 'aSucursales'));  
            
            $msg["estado"] = "danger";
            $msg["mensaje"] = "Antes de agregar un producto a tu carrito, debes loguearte.";
            return view("web.takeaway", compact('msg', 'pg', 'producto', 'aProductos', 'aCategorias', 'aSucursales'));   
    }

}
    }
}

?>