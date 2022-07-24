<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido; 
use App\Entidades\Sistema\MenuArea;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorPedido extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo menú";
        return view('pedido.pedido-nuevo', compact('titulo'));
            }

            public function guardar(Request $request) {
                try {
                    //Define la entidad servicio
                    $titulo = "Modificar pedido";
                    $entidad = new Pedido();
                    $entidad->cargarDesdeRequest($request);
        
                    //validaciones
                    if ($entidad->nombre == "") {
                        $msg["ESTADO"] = MSG_ERROR;
                        $msg["MSG"] = "Complete todos los datos";
                    } else {
                        if ($_POST["id"] > 0) {
                            //Es actualizacion
                            $entidad->guardar();
        
                            $msg["ESTADO"] = MSG_SUCCESS;
                            $msg["MSG"] = OKINSERT;
                        } else {
                            //Es nuevo
                            $entidad->insertar();
        
                            $msg["ESTADO"] = MSG_SUCCESS;
                            $msg["MSG"] = OKINSERT;
                        }
                      
                        $_POST["id"] = $entidad->idpedido;
                        return view('sistema.menu-listar', compact('titulo', 'msg'));
                    }
                } catch (Exception $e) {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = ERRORINSERT;
                }
        
                $id = $entidad->pedido;
                $cliente = new Pedido();
                $cliente->obtenerPorId($id);
                return view('pedido.pedido-nuevo', compact('msg', 'cliente', 'titulo')) . '?id=' . $pedido->idpedido;
        
            }            
      }