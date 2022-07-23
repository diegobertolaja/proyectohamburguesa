<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal; 
use App\Entidades\Sistema\MenuArea;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorSucursal extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo menú";
        return view('sucursal.sucursal-nuevo', compact('titulo'));
            }

      }