<?php

namespace App\Http\Controllers;
use App\Entidades\Producto;
use App\Entidades\Categoria;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;

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
        
        return view("web.takeaway", compact('pg', 'producto', '$aProductos', '$aCategorias', '$aSucursales'));
    }
}
